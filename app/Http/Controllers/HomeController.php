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
        $metrics = Metric::select('name', 'code')->get();
        $businesses = Business::select('name', 'page_id')->get();

        return view('tool', compact('metrics', 'businesses'));
    }

    public function result(Request $request)
    {
        $business = Business::where('page_id', $request->page_id)->firstOrFail();
        $metrics = Metric::select('name', 'description')->get();
        $data = $this->get_analytics($business, $request->metrics)["data"];

        foreach ($data as $item) {
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

        $results = Result::where('page_id', $business->page_id)->get();
        $long_text = 'data: { ';

        $labels = array();
        $values = array();
        foreach ($results as $result) {
            $long_text .= '[metric name: ' . $result->metric_name . ', metric period: ' . $result->metric_period . ', end time: ' . $result->end_time1 . ', value: ' . $result->value1 . ', end time: ' . $result->end_time2 . ', value: ' . $result->value2  . '] ';

            $labels[] = array(
                'label' => $result->metric_name . " " . $result->metric_period,
            );

            $values[] = array(
                'value1' => $result->value1,
                'value2' => $result->value2
            );
        }
        $long_text .= ' }';

        // $gpt_response = $this->chatgpt($long_text);
        $gpt_response = $long_text;

        // return $data;
        return view('result', compact('data', 'gpt_response', 'labels', 'values', 'metrics'));
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

    private function get_analytics($business, $metrics)
    {
        $graphApiUrl = 'https://graph.facebook.com/v18.0/' . $business->page_id . '/insights?metric=';

        $metricArray = [];

        foreach ($metrics as $metric) {
            $metricArray[] = $metric;
        }

        $graphApiUrl .= implode(',', $metricArray);

        $graphApiUrl .= '&access_token=' . $business->access_token;

        $client = new Client();
        $response = $client->get($graphApiUrl);

        $data = json_decode($response->getBody(), true);
        return $data;
    }
}
