@extends('layouts.app')

@section('content')

<script src="{{ asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>

<div class="container">
    <div class="d-flex justify-content-start">
        <a href="{{ route('tool') }}" class="mb-3 btn btn-secondary">Back</a>
    </div>

    <h3 class="my-4">Result</h3>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-block">
                @foreach ($data as $counter => $item)
                <h3>{{ ucwords(str_replace('_', ' ', $item['name'])) }} <small>({{ $item['period'] }})</small> </h3>
                <div class="d-flex justify-content-around align-item-center mt-3">
                    <div>
                        {{ DateTime::createFromFormat('Y-m-d\TH:i:sO',
                        $item['values'][0]['end_time'])->format('d/m/Y') }} :
                        <span class="text-info">{{$item['values'][0]['value'] }}</span>
                    </div>
                    <div>
                        {{ DateTime::createFromFormat('Y-m-d\TH:i:sO',
                        $item['values'][1]['end_time'])->format('d/m/Y') }} :
                        <span
                            class="text-{{ Helper::compare($item['values'][0]['value'], $item['values'][1]['value']) }}">{{
                            $item['values'][1]['value'] }}</span>
                    </div>
                </div>

                <canvas class="mt-3" id="team-chart-{{ $counter }}"></canvas>
                <script>
                    (function ($) {
                        "use strict";
                        try {
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

                <br><br>
                @endforeach
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
        <div class="card">
            <div class="card-body card-block">
                <p class="mb-4">This is a list of all metrics with a short explanation of each of them.</p>
                <table class="w-100 m-0">
                    <thead>
                        <tr>
                            <th>Metric Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($metrics as $metric)
                        <tr>
                            <td>{{ $metric->name }}</td>
                            <td>{{ $metric->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection