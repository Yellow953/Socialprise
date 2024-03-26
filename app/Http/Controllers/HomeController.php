<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\Result;
use App\Models\Business;
use Illuminate\Http\Request;
use DateTime;
use OpenAI;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('index');
    }

    public function tool()
    {
        $facebook_metrics = Metric::select('name', 'code')->where('platform', 'facebook')->get();
        $instagram_metrics = Metric::select('name', 'code')->where('platform', 'instagram')->get();
        $businesses = Business::select('name', 'page_id')->get();

        return view('tool', compact('facebook_metrics', 'instagram_metrics', 'businesses'));
    }

    public function result(Request $request)
    {
        $business = Business::where('page_id', $request->page_id)->firstOrFail();
        $metrics = Metric::select('name', 'description')->get();
        $facebook_data = $this->get_facebook_analytics($business, $request->facebook_metrics)["data"];
        $instagram_data = $this->get_instagram_analytics($business, $request->instagram_metrics)["data"];

        foreach ($facebook_data as $item) {
            Result::create([
                "type" => "facebook",
                'page_id' => $business->page_id,
                'metric_name' => $item['name'],
                'metric_period' => $item['period'],
                'end_time1' => DateTime::createFromFormat('Y-m-d\TH:i:sO', $item['values'][0]['end_time']),
                'value1' => $item['values'][0]['value'],
                'end_time2' => DateTime::createFromFormat('Y-m-d\TH:i:sO', $item['values'][1]['end_time']),
                'value2' => $item['values'][1]['value'],
            ]);
        }

        foreach ($instagram_data as $item) {
            Result::create([
                "type" => "instagram",
                'page_id' => $business->instagram_business_account,
                'metric_name' => $item['name'],
                'metric_period' => $item['period'],
                'end_time1' => DateTime::createFromFormat('Y-m-d\TH:i:sO', $item['values'][0]['end_time']),
                'value1' => $item['values'][0]['value'],
                'end_time2' => DateTime::createFromFormat('Y-m-d\TH:i:sO', $item['values'][1]['end_time']),
                'value2' => $item['values'][1]['value'],
            ]);
        }

        $facebook_results = Result::where('page_id', $business->page_id)->get();
        $long_text = 'Facebook data: { ';

        $labels_facebook = array();
        $values_facebook = array();
        foreach ($facebook_results as $result) {
            $long_text .= '[metric name: ' . $result->metric_name . ', metric period: ' . $result->metric_period . ', end time: ' . $result->end_time1 . ', value: ' . $result->value1 . ', end time: ' . $result->end_time2 . ', value: ' . $result->value2  . '] ';

            $labels_facebook[] = array(
                'label' => $result->metric_name . " " . $result->metric_period,
            );

            $values_facebook[] = array(
                'value1' => $result->value1,
                'value2' => $result->value2
            );
        }
        $long_text .= ' }';

        $instagram_results = Result::where('page_id', $business->instagram_business_account)->get();
        $long_text .= '. Instagram data: { ';

        $labels_instagram = array();
        $values_instagram = array();
        foreach ($instagram_results as $result) {
            $long_text .= '[metric name: ' . $result->metric_name . ', metric period: ' . $result->metric_period . ', end time: ' . $result->end_time1 . ', value: ' . $result->value1 . ', end time: ' . $result->end_time2 . ', value: ' . $result->value2  . '] ';

            $labels_instagram[] = array(
                'label' => $result->metric_name . " " . $result->metric_period,
            );

            $values_instagram[] = array(
                'value1' => $result->value1,
                'value2' => $result->value2
            );
        }
        $long_text .= ' }';

        // $gpt_response = $this->chatgpt($long_text);
        $gpt_response = $long_text;

        $data = compact('facebook_data', 'instagram_data', 'gpt_response', 'labels_facebook', 'values_facebook', 'labels_instagram', 'values_instagram', 'metrics');

        // return $facebook_data;
        return view('result', $data);
    }

    public function analyse(Request $request)
    {
        return $this->chatgpt($request);
    }

    // Private
    private function chatgpt($data)
    {
        $yourApiKey = getenv('OPENAI_API_KEY');
        $client = OpenAI::client($yourApiKey);

        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'assistant', 'content' => 'act as a social media analyst look at the business suite facebook insights below and give me a short analysis of the situation in common terms. data: ' . $data],
            ],
        ]);

        return $response->choices[0]->message->content;
    }

    private function get_facebook_analytics($business, $metrics)
    {
        $graphApiUrl = 'https://graph.facebook.com/v19.0/' . $business->page_id . '/insights?metric=';

        $metricArray = [];

        foreach ($metrics as $metric) {
            $metricArray[] = $metric;
        }

        $metrics = Metric::whereIn('code', $metricArray)->where('platform', 'facebook')->get();

        $graphApiUrl .= implode(',', $metrics->pluck('code')->toArray());

        $graphApiUrl .= '&access_token=' . $business->access_token;

        $client = new Client();
        $response = $client->get($graphApiUrl);

        $data = json_decode($response->getBody(), true);
        return $data;
    }

    private function get_instagram_analytics($business, $metrics)
    {
        //https: //graph.facebook.com/v19.0/17841452749614836/insights?metric=follower_count,reach&period=day&access_token=EAAUUCEZBUZAC8BOZBZAxzJJd1pEtfUykQRKTmznfxkVVXDiIghgJH4t5klqgfpJ2o73pp3aNjqPBtzyQ846QvE1xmKORBhrTuzOgX2xZBDpXpGuSMVyfO4xLCssxGy9cjsxQZAbtOvQ1BwocFklDFZCcpZACREeguodH48Fm56rbWugdBmY3b8bfKkiSBq2R4v4wLTqFfP6CKxkT

        $graphApiUrl = 'https://graph.facebook.com/v19.0/' . $business->instagram_business_account . '/insights?metric=';

        $metricArray = [];

        foreach ($metrics as $metric) {
            $metricArray[] = $metric;
        }

        $metrics = Metric::whereIn('code', $metricArray)->where('platform', 'instagram')->get();

        $graphApiUrl .= implode(',', $metrics->pluck('code')->toArray());

        $graphApiUrl .= '&period=day&access_token=' . $business->access_token;

        $client = new Client();
        $response = $client->get($graphApiUrl);

        $data = json_decode($response->getBody(), true);
        return $data;
    }
}
