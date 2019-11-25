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
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js" integrity="sha256-S1J4GVHHDMiirir9qsXWc8ZWw74PHHafpsHp5PXtjTs=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.3.0/echarts.min.js" integrity="sha256-iD9Ih0W2BOZqGT6/0OvowPNCQW0lLz+tBKd16Oa7bHc=" crossorigin="anonymous"></script>
        <style>
            .chart-style
            {
                height:300px;
            }
        </style>
    </head>
    <body>
        @include('templateTest')
         
        <p>
        </p>
        <p id = "category"></p>
        <div id="print_area">

        <!-- <p id = "each_data"></p> -->
       </div>
        <script>
            var baseURL = "{!! url('/') !!}";
           // var temp_obj;
        //    var all_category = []
            function get_list(){
                //each_category;
                console.log(baseURL+'/api/pttindexcategory')
                axios.get(baseURL+'/api/pttindexcategory')

                .then(function(response){
                    console.log('load_status '+response.status)
                    current_item = response.data
                    //temp_obj = response.data
              
                    
                    all_category = current_item.category
                    console.log('load_data '+all_category)
                    document.getElementById("category").innerHTML = all_category
                    
                    console.log('category length'+all_category.length)
                    write_place(all_category)
                    for (var i =0; i<all_category.length; i++){
                        console.log('which category'+ all_category[i])
                        get_data(all_category[i])
                    }

                })
                .catch(function (error) {
                    console.log(error);
                });
                
            }
            function get_data(category){
                console.log(baseURL+'/api/pttshow/'+category)
                axios.get(baseURL+'/api/pttshow/'+category)
                .then(function(response){
                    console.log('load_status'+response.status)
                    current_item = response.data
                    each_data =  current_item.results
                    
                    console.log('each_data '+each_data.length)
                    eachday_data_string = ""
                    temp_day = []
                    temp_count = []
                    for (var i=0; i<each_data.length; i++){
                        if (i!= each_data.length-1){
                            temp_day.push(each_data[i].day)
                            temp_count.push(parseInt(each_data[i].count))
                            eachday_data_string+= each_data[i].day+":"+each_data[i].count+" ,"
                        }
                        else{
                            temp_day.push(each_data[i].day)
                            temp_count.push(parseInt(each_data[i].count))
                            eachday_data_string+= each_data[i].day+":"+each_data[i].count
                        }
                    }

                 //   document.getElementById("each_data_"+category).innerHTML =category+":"+eachday_data_string
                  // drawBarHighCharts(temp_day, temp_count, category, "each_data_"+category)
                  drawBarEcharts(temp_day, temp_count, category, "each_data_"+category)
                })
                .catch(function (error) {
                    console.log(error);
                });

            }
            function write_place(category){
                var parent = document.getElementById("print_area")
                console.log('category:'+category)
                var each_category_show =""
                if(parent !== null){
                    
                    console.log('category:'+category)
                    for (var i =0 ;i<category.length; i++){
                        each_category_show += '<div id="each_data_' + category[i] + '" class="chart-style"> \n';
                        each_category_show += '</div>'; 
                    }
                }
                for (var i =0; i<category.length; i++){
                    var temp_cat_show = get_data(category[i]);
                }
                parent.innerHTML = each_category_show
            }

            function drawBarHighCharts( each_day, each_count, category, place_id){
                var stack_column = new Highcharts.chart(place_id,{
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: category+' column chart'
                        },
                    xAxis: {
                        categories:each_day
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
                        name: category,
                        data: each_count,
                    }]
                });

                console.log(each_count)


            }

            function drawBarEcharts(each_day, each_count, category, place_id){
                var myCharts = echarts.init(document.getElementById(place_id));
                var option = {
                    title: {
                        text: category+' Bar'
                    },
                    color: ['#3398DB'],
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {  
                            type : 'shadow'  
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : each_day,
                            axisTick: {
                                alignWithLabel: true
                            }

                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name: category,
                            type:'bar',
                            barWidth: '60%',
                            data: each_count
                        }
                    ]

                };
                myCharts.setOption(option);

            }
            get_list()
        </script>
    </body>
</html>