@extends('layouts.app')

@section('content')
<script src="{{ asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>


<div class="container">
    <div class="d-flex justify-content-start">
        <a href="/tool" class="mb-3 btn btn-secondary">Back</a>
    </div>

    <h3 class="my-4">Result</h3>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-block">
                <table class="m-0" style="width: 100%!important;">
                    <tr>
                        <th class="text-center">Metric</th>
                        <th class="text-center">Date1</th>
                        <th class="text-center">Value1</th>
                        <th class="text-center">Date2</th>
                        <th class="text-center">Value2</th>
                        <th class="text-center">Graph</th>
                    </tr>

                    @foreach ($data as $counter => $item)
                    <tr>
                        <td>
                            {{ $item['name'] }} <br>
                            {{ $item['period'] }}
                        </td>
                        <td>{{ DateTime::createFromFormat('Y-m-d\TH:i:sO',
                            $item['values'][0]['end_time'])->format('d/m/Y') }}</td>
                        <td>
                            <span class="text-info">{{$item['values'][0]['value'] }}</span>
                        </td>
                        <td>{{ DateTime::createFromFormat('Y-m-d\TH:i:sO',
                            $item['values'][1]['end_time'])->format('d/m/Y') }}</td>
                        <td>
                            <span
                                class="text-{{ Helper::compare($item['values'][0]['value'], $item['values'][1]['value']) }}">{{
                                $item['values'][1]['value'] }}</span>
                        </td>
                        <td>
                            <canvas id="team-chart-{{ $counter }}"></canvas>
                            <script>
                                (function ($) {
                                    // USE STRICT
                                    "use strict";
                                    try {
                                        //Team chart
                                        var ctx = document.getElementById("team-chart-" + {{ $counter }});
                                        if (ctx) {
                                        ctx.height = 100;
                                        var myChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                            labels: ["{{ DateTime::createFromFormat('Y-m-d\TH:i:sO', $item['values'][0]['end_time'])->format('d/m/Y') }}", "{{ DateTime::createFromFormat('Y-m-d\TH:i:sO', $item['values'][1]['end_time'])->format('d/m/Y') }}"],
                                            type: 'line',
                                            defaultFontFamily: 'Poppins',
                                            datasets: [{
                                                data: [{{ $item['values'][0]['value'] }}, {{ $item['values'][1]['value'] }}],
                                                label: "Expense",
                                                backgroundColor: '{{ Helper::compare_hex_bg($item['values'][0]['value'], $item['values'][1]['value']) }}',
                                                borderColor: '{{ Helper::compare_hex_border($item['values'][0]['value'], $item['values'][1]['value']) }}',
                                                borderWidth: 3.5,
                                                pointStyle: 'circle',
                                                pointRadius: 5,
                                                pointBorderColor: 'transparent',
                                                pointBackgroundColor: 'rgba(0,103,255,0.5)',
                                            },]
                                            },
                                            options: {
                                            responsive: true,
                                            tooltips: {
                                                mode: 'index',
                                                titleFontSize: 12,
                                                titleFontColor: '#000',
                                                bodyFontColor: '#000',
                                                backgroundColor: '#fff',
                                                titleFontFamily: 'Poppins',
                                                bodyFontFamily: 'Poppins',
                                                cornerRadius: 3,
                                                intersect: false,
                                            },
                                            legend: {
                                                display: false,
                                                position: 'top',
                                                labels: {
                                                usePointStyle: true,
                                                fontFamily: 'Poppins',
                                                },


                                            },
                                            scales: {
                                                xAxes: [{
                                                display: true,
                                                gridLines: {
                                                    display: false,
                                                    drawBorder: false
                                                },
                                                scaleLabel: {
                                                    display: false,
                                                    labelString: 'Month'
                                                },
                                                ticks: {
                                                    fontFamily: "Poppins"
                                                }
                                                }],
                                                yAxes: [{
                                                display: true,
                                                gridLines: {
                                                    display: false,
                                                    drawBorder: false
                                                },
                                                scaleLabel: {
                                                    display: true,
                                                    labelString: 'Value',
                                                    fontFamily: "Poppins"
                                                },
                                                ticks: {
                                                    fontFamily: "Poppins"
                                                }
                                                }]
                                            },
                                            title: {
                                                display: false,
                                            }
                                            }
                                        });
                                        }
                                    } catch (error) {
                                        console.log(error);
                                    }
                                })(jQuery);
                            </script>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <h3 class="my-4">AI Analysis</h3>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-block">
                <p>{{ $gpt_response }}</p>
            </div>
        </div>
    </div>

    <h3 class="my-4">Metrics</h3>
    <div class="row">
        @foreach ($metrics as $metric)
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $metric->name }}</strong>
                </div>
                <div class="card-body card-block">
                    <p>{{ $metric->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection