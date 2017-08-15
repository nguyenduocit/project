@extends('quanlytaichinh.main')
    @section('title')
      Home Wallets
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Money Lover
                <small>Select wallet to view your wallet information</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li></li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-body">
                        <div class="box-header">
                          @include('quanlytaichinh.include.alert')
                            <div class="row">
                                
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive "><!-- no-padding hien thi thanh truot keo xuong-->
                            @foreach($listWallets as $val)
                                <div class="col-lg-3 col-xs-6">
                                  <!-- small box -->
                                  <div class="small-box " style="background: {{ $val -> color }};">
                                    <div class="inner">
                                      <b>{{ number_format($val->amount) }}đ</b>

                                      <p>{{ the_excerpt($val->name,50) }} @if(strlen($val->name)  > STRING_MIN) ... @endif</p>
                                    </div>
                                    <div class="icon">
                                      <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="{{ URL::route('wallets.getInfoWallets', $val->id) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                  </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4 text-center">{!! $listWallets -> links()!!}</div>
                            <div class="col-sm-4"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box-body -->
                </div>
                  <!-- /.box -->
            </section>
            <section class="content-header">
              <h1>
                Money Lover ChartJS
                <small>Preview sample</small>
              </h1>
            </section>

            {{-- Chart --}}
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-sm-3">
                            <div class="dataTables_length" id="example1_length" style="padding-top: 15px;">
                                <?php 
                                    $date = \Carbon\Carbon::now();
                                    $year_now = $date->year;
                                    $year = $year_now - 5;
                                ?>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-4 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Select Year</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('type')) has-error @endif">
                                            <select name="type" id="type-transaction"   class="form-control select2 select2-hidden-accessible select-year" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                <option value=""></option>
                                                @for($i=0 ; $i< 15 ; $i++)

                                                    {{ $year = $year +1}}
                                                    <option @if($year_now == $year) selected="selected" @endif value="{{$year}}">{{ $year}}</option>
                                    
                                                @endfor
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('type') }}</p></span>
                                        </div>
                                        <div class="col-md-1 col-sm-3 col-xs-0 ">

                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="dataTables_length" id="example1_length" style="padding-top: 15px;">
                                <label>
                                  Select Wallets
                                   <select id="select-category" class="select-wallets" multiple="multiple">

                                    @foreach($listWallets as $val)
                                    <option value="{{$val->id}}">{{ $val->name }}</option>
                                    @endforeach
                                    
                                  </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                          <!-- BAR CHART -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Bar Chart  </h3>

                                <div class="box-tools pull-right">
                                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                  <canvas id="barChart" style="height: 250px; width: 755px;" width="755" height="230"></canvas>
                                </div>
                            </div>
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                        <!-- DONUT CHART -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Chart Categorys Expenses</h3>

                                <div class="box-tools pull-right">
                                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <canvas id="pieChart" style="height: 387px; width: 775px;" width="775" height="387"></canvas>
                            </div>
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">

                        <!-- AREA CHART -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Area Chart</h3>

                                <div class="box-tools pull-right">
                                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                  <canvas id="areaChart" style="height: 250px; width: 755px;" width="755" height="250"></canvas>
                                </div>
                            </div>
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        <!-- LINE CHART -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title"> Chart Categorys Incom </h3>

                                <div class="box-tools pull-right">
                                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                          <div class="box-body">
                            <div class="chart">
                              <canvas id="pieChartTest" style="height: 387px; width: 755px;" width="755" height="250"></canvas>
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
            <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <script>

          $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas);

            var areaChartData = {
              labels: ["January", "February", "March", "April", "May", "June", "July" ,"August", "September" ,"October","November" ,"December"],
              datasets: [
                {
                  label: "Electronics",
                  fillColor: "rgba(210, 214, 222, 1)",
                  strokeColor: "rgba(210, 214, 222, 1)",
                  pointColor: "rgba(210, 214, 222, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: [

                        @for($i =0 ;$i<12 ;$i++)
                            {{ $resultExpenses[$i]}},
                        @endfor
                  ]
                },
                {
                  label: "Digital Goods",
                  fillColor: "rgba(60,141,188,0.9)",
                  strokeColor: "rgba(60,141,188,0.8)",
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(60,141,188,1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(60,141,188,1)",
                  data: [

                        @for($i =0 ;$i<12 ;$i++)
                            {{ $resultIncom[$i]}},
                        @endfor
                  ]
                }
              ]
            };

            var areaChartOptions = {
              //Boolean - If we should show the scale at all
              showScale: true,
              //Boolean - Whether grid lines are shown across the chart
              scaleShowGridLines: false,
              //String - Colour of the grid lines
              scaleGridLineColor: "rgba(0,0,0,.05)",
              //Number - Width of the grid lines
              scaleGridLineWidth: 1,
              //Boolean - Whether to show horizontal lines (except X axis)
              scaleShowHorizontalLines: true,
              //Boolean - Whether to show vertical lines (except Y axis)
              scaleShowVerticalLines: true,
              //Boolean - Whether the line is curved between points
              bezierCurve: true,
              //Number - Tension of the bezier curve between points
              bezierCurveTension: 0.3,
              //Boolean - Whether to show a dot for each point
              pointDot: false,
              //Number - Radius of each point dot in pixels
              pointDotRadius: 4,
              //Number - Pixel width of point dot stroke
              pointDotStrokeWidth: 1,
              //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
              pointHitDetectionRadius: 20,
              //Boolean - Whether to show a stroke for datasets
              datasetStroke: true,
              //Number - Pixel width of dataset stroke
              datasetStrokeWidth: 2,
              //Boolean - Whether to fill the dataset with a color
              datasetFill: true,
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
              //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio: true,
              //Boolean - whether to make the chart responsive to window resizing
              responsive: true
            };

            //Create the line chart
            areaChart.Line(areaChartData, areaChartOptions);

            //-------------
            //- LINE CHART -
            //--------------
            //var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
            // var lineChart = new Chart(lineChartCanvas);
            // var lineChartOptions = areaChartOptions;
            // lineChartOptions.datasetFill = false;
            // lineChart.Line(areaChartData, lineChartOptions);

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas);
            var PieData = [
                @foreach($dataCategoryExpenses as $val)
                  {
                    value: {{ $val->total}},
                    color: "{{$val->color}}",
                    highlight: "{{$val->color}}",
                    label: "{{$val->name}}"
                  },
                @endforeach
            ];
            var pieOptions = {
              //Boolean - Whether we should show a stroke on each segment
              segmentShowStroke: true,
              //String - The colour of each segment stroke
              segmentStrokeColor: "#fff",
              //Number - The width of each segment stroke
              segmentStrokeWidth: 2,
              //Number - The percentage of the chart that we cut out of the middle
              percentageInnerCutout: 50, // This is 0 for Pie charts
              //Number - Amount of animation steps
              animationSteps: 100,
              //String - Animation easing effect
              animationEasing: "easeOutBounce",
              //Boolean - Whether we animate the rotation of the Doughnut
              animateRotate: true,
              //Boolean - Whether we animate scaling the Doughnut from the centre
              animateScale: false,
              //Boolean - whether to make the chart responsive to window resizing
              responsive: true,
              // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio: true,
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);

            //-------------
            //- PIE CHART TEST -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $("#pieChartTest").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas);
            var PieData = [
              @foreach($dataCategoryIncom as $val)
                  {
                    value: {{ $val->total}},
                    color: "{{$val->color}}",
                    highlight: "{{$val->color}}",
                    label: "{{$val->name}}"
                  },
                @endforeach
            ];
            var pieOptions = {
              //Boolean - Whether we should show a stroke on each segment
              segmentShowStroke: true,
              //String - The colour of each segment stroke
              segmentStrokeColor: "#fff",
              //Number - The width of each segment stroke
              segmentStrokeWidth: 2,
              //Number - The percentage of the chart that we cut out of the middle
              percentageInnerCutout: 50, // This is 0 for Pie charts
              //Number - Amount of animation steps
              animationSteps: 100,
              //String - Animation easing effect
              animationEasing: "easeOutBounce",
              //Boolean - Whether we animate the rotation of the Doughnut
              animateRotate: true,
              //Boolean - Whether we animate scaling the Doughnut from the centre
              animateScale: false,
              //Boolean - whether to make the chart responsive to window resizing
              responsive: true,
              // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio: true,
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;
            barChartData.datasets[1].fillColor = "#00a65a";
            barChartData.datasets[1].strokeColor = "#00a65a";
            barChartData.datasets[1].pointColor = "#00a65a";
            var barChartOptions = {
              //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
              scaleBeginAtZero: true,
              //Boolean - Whether grid lines are shown across the chart
              scaleShowGridLines: true,
              //String - Colour of the grid lines
              scaleGridLineColor: "rgba(0,0,0,.05)",
              //Number - Width of the grid lines
              scaleGridLineWidth: 1,
              //Boolean - Whether to show horizontal lines (except X axis)
              scaleShowHorizontalLines: true,
              //Boolean - Whether to show vertical lines (except Y axis)
              scaleShowVerticalLines: true,
              //Boolean - If there is a stroke on each bar
              barShowStroke: true,
              //Number - Pixel width of the bar stroke
              barStrokeWidth: 2,
              //Number - Spacing between each of the X value sets
              barValueSpacing: 5,
              //Number - Spacing between data sets within X values
              barDatasetSpacing: 1,
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
              //Boolean - whether to make the chart responsive
              responsive: true,
              maintainAspectRatio: true
            };

            barChartOptions.datasetFill = false;
            barChart.Bar(barChartData, barChartOptions);
          });
        </script>
    @stop

