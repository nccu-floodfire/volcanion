<!doctyp html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <title> PTT Summary </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script></head>
    </head>
        <body>
            <!--
            <div class = "container">
                <div class = "jumbotron">
                <h1> Ptt Summary </h1>
                </div>
            </div> -->
            @include('templateTest')
            <p>


            </p>
            <div class="container_test">
<!---
                @foreach($all_data as $data)
                    {{ $data['id']}}
                @endforeach
                @foreach($cat_hate as $hate)
                    {{ $hate['category']}}
                @endforeach
                @foreach($cat_month as $month_date)
                    {{ $month_date['new_date'] }}
                    {{ $month_date['category'] }}
                @endforeach -->
            </div>
<!--            
            <div id="container">
                <script>
                   var stack_column = new Highcharts.chart('container', {
                                     chart: {
                                            type: 'column'
                                    },
                                    title: {
                                            text: 'Stacked column chart'
                                    },
                                    xAxis: {
                                        categories: [@foreach($each_day as $day) @if($loop ->last) '{{ $day['date']}}' @else '{{ $day['date'] }}', @endif @endforeach]
                                     },
                                    yAxis: {
                                            min: 0,
                                            title: {
                                            text: 'Total fruit consumption'
                                            },
                                            stackLabels: {
                                                enabled: true,
                                                style: {
                                                    fontWeight: 'bold',
                                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                                }
                                            }
                                    },
                                    legend: {
                                            align: 'right',
                                            x: -30,
                                            verticalAlign: 'top',
                                            y: 25,
                                            floating: true,
                                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                                            borderColor: '#CCC',
                                            borderWidth: 1,
                                            shadow: false
                                    },
                                    tooltip: {
                                            headerFormat: '<b>{point.x}</b><br/>',
                                            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                    },
                                    plotOptions: {
                                        column: {
                                            stacking: 'normal',
                                            dataLabels: {
                                            enabled: true,
                                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                                            }
                                        }
                                    },
series: [{
    name: '政黑',
    data: [@foreach($each_day as $day) @if($loop -> last) {{ $day['政黑'] }} @else {{ $day['政黑']}}, @endif @endforeach]
  }, {
    name: '八卦',
    data: [@foreach($each_day as $day) @if($loop -> last) {{ $day['八卦'] }} @else {{ $day['八卦']}}, @endif @endforeach]
  }]
});
                </script>
            </div>
            -->
            <div id="container_hate">
                <script>
                   var stack_column = new Highcharts.chart('container_hate', {
                                     chart: {
                                            type: 'column'
                                    },
                                    title: {
                                            text: '政黑 column chart'
                                    },
                                    xAxis: {
                                        categories: [@foreach($cat_hate_eachday as $day) @if($loop ->last) '{{ $day['day']}}' @else '{{ $day['day'] }}', @endif @endforeach]
                                     },
                                    yAxis: {
                                            min: 0,
                                            title: {
                                            text: '筆數'
                                            },
                                            stackLabels: {
                                                enabled: true,
                                                style: {
                                                    fontWeight: 'bold',
                                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                                }
                                            }
                                    },
                                    legend: {
                                            align: 'right',
                                            x: -30,
                                            verticalAlign: 'top',
                                            y: 25,
                                            floating: true,
                                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                                            borderColor: '#CCC',
                                            borderWidth: 1,
                                            shadow: false
                                    },
                                    tooltip: {
                                            headerFormat: '<b>{point.x}</b><br/>',
                                            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                    },
                                    plotOptions: {
                                        column: {
                                            stacking: 'normal',
                                            dataLabels: {
                                            enabled: true,
                                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                                            }
                                        }
                                    },
series: [{
    name: '政黑',
    data: [@foreach($cat_hate_eachday as $day) @if($loop -> last) {{ $day['count'] }} @else {{ $day['count']}}, @endif @endforeach]
  }]
});
                </script>
            </div>
            <div id="container_gossip">
                <script>
                   var stack_column = new Highcharts.chart('container_gossip', {
                                     chart: {
                                            type: 'column'
                                    },
                                    title: {
                                            text: '八卦 column chart'
                                    },
                                    xAxis: {
                                        categories: [@foreach($cat_gossip_eachday as $day) @if($loop ->last) '{{ $day['day']}}' @else '{{ $day['day'] }}', @endif @endforeach]
                                     },
                                    yAxis: {
                                            min: 0,
                                            title: {
                                            text: '筆數'
                                            },
                                            stackLabels: {
                                                enabled: true,
                                                style: {
                                                    fontWeight: 'bold',
                                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                                }
                                            }
                                    },
                                    legend: {
                                            align: 'right',
                                            x: -30,
                                            verticalAlign: 'top',
                                            y: 25,
                                            floating: true,
                                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                                            borderColor: '#CCC',
                                            borderWidth: 1,
                                            shadow: false
                                    },
                                    tooltip: {
                                            headerFormat: '<b>{point.x}</b><br/>',
                                            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                    },
                                    plotOptions: {
                                        column: {
                                            stacking: 'normal',
                                            dataLabels: {
                                            enabled: true,
                                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                                            }
                                        }
                                    },
series: [{
    color: '#000000',
    name: '八卦',
    data: [@foreach($cat_gossip_eachday as $day) @if($loop -> last) {{ $day['count'] }} @else {{ $day['count']}}, @endif @endforeach]
  }]
});
                </script>
            </div>
        </body>
</html>
