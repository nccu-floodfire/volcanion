<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title> Twitter Summary </title>
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
        <p id = "each_category"></p>
        <div id="print_area">

        <!-- <p id = "each_data"></p> -->
       </div>
        <script>
            var baseURL = "{!! url('/') !!}";
            function get_list(){
                console.log(baseURL+'/api/newsindexcategory')
                axios.get(baseURL+'/api/newsindexcategory')
                .then(function(response){
                    console.log('load_status '+response.status)
                    current_item = response.data
                    all_category = current_item.category
                    console.log('load_data '+all_category)
                    document.getElementById("each_category").innerHTML = all_category
                    console.log('category length'+all_category.length)
                    write_place(all_category)
                    for (var i =0; i<all_category.length; i++){
                        console.log('which category '+ all_category[i])
                        get_data(all_category[i])
                    }
                })
                .catch(function (error) {
                        console.log(error);
                    });
            }
            function get_data(category){
                console.log(baseURL+'/api/newsshow/'+category)
                axios.get(baseURL+'/api/newsshow/'+category)
                .then(function(response){
                    console.log('load_status'+response.status)
                    current_item = response.data
                    each_data_list =  current_item.results.list
                    each_data_page = current_item.results.page
                    console.log('each_data '+each_data_list.length)
                    eachday_data_string_list = "list "
                    eachday_data_string_page = "page "
                    temp_day = []
                    temp_count = []
                    for (var i=0; i<each_data_list.length; i++){
                        if (i!= each_data_list.length-1){
                            temp_day.push(each_data_list[i].day)
                            temp_count.push(parseInt(each_data_list[i].count))
                            eachday_data_string_list+= each_data_list[i].day+":"+each_data_list[i].count+" ,"
                        }
                        else{
                            temp_day.push(each_data_list[i].day)
                            temp_count.push(parseInt(each_data_list[i].count))
                            eachday_data_string_list+= each_data_list[i].day+":"+each_data_list[i].count
                        }
                    }
                    console.log("error : each_data_list_"+category)
                    //document.getElementById("each_data_list_"+category).innerHTML =category+":"+eachday_data_string_list
                    drawBarEcharts(temp_day, temp_count, category, "each_data_list_"+category, 'blue')
                    for (var i=0; i<each_data_page.length; i++){
                        if (i!= each_data_page.length-1){
                            temp_day.push(each_data_page[i].day)
                            temp_count.push(parseInt(each_data_page[i].count))
                            eachday_data_string_page+= each_data_page[i].day+":"+each_data_page[i].count+" ,"
                        }
                        else{
                            temp_day.push(each_data_list[i].day)
                            temp_count.push(parseInt(each_data_page[i].count))
                            eachday_data_string_page+= each_data_page[i].day+":"+each_data_page[i].count
                        }
                    }
                    console.log("error : each_data_page_"+category+' '+eachday_data_string_page)
                    //document.getElementById("each_data_page_"+category).innerHTML =category+":"+eachday_data_string_page
                    drawBarEcharts(temp_day, temp_count, category, "each_data_page_"+category, 'black')
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
                        each_category_show += '<div id="each_data_list_' + category[i] + '" class="chart-style"> \n';
                        each_category_show += '</div> \n'; 
                        each_category_show += '<div id="each_data_page_' + category[i] + '" class="chart-style"> \n';
                        each_category_show += '</div> \n'; 
                    }
                    console.log(each_category_show)
                    parent.innerHTML = each_category_show
                }
            }



            get_list()

            function drawBarEcharts(each_day, each_count, category, place_id, set_color){
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
                            color:set_color,
                            type:'bar',
                            barWidth: '60%',
                            data: each_count
                        }
                    ]

                };
                myCharts.setOption(option);

            }

        </script>
        
    </body>
</html>
