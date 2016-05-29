@extends('pages.dashboard')

@section('ownerOrDepartmentalTiles')
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Overall Statistics<i class="analysisType"></i></h3>

        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <b id="totalProduction">---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
                            <p id="totalProductionDate">(Date Time)</p>
                        </h3>
                        <p>Total Production</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <b id="upTime">---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
                            <p id="upTimeDate">(Date Time)</p>
                        </h3>

                        <p>UpTime</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <b id="downTime">---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
                            <p id="downTimeDate">(Date Time)</p>
                        </h3>

                        <p>DownTime</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <b id="anythingElse">---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
                            <p id="anythingElseDate">(Date Time)</p>
                        </h3>

                        <p>Anything else</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        {{--<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">--}}
            {{--Productions from each departments--}}
        {{--</a>--}}
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="float: right">
            Productions from each departments
        </button>
        <br/><br/>
        <div class="collapse" id="collapseExample">
            <br/>
            @foreach($productionData['descendants'][\Carbon\Carbon::now()->format("Y-m-d")] as $descendant)
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <!-- small box -->
                    <div class="small-box bg-light-blue-gradient">
                        <div class="inner">
                            <h3>
                                <b id="{{$descendant['deptName']}}_{{$descendant['meter_name']}}" >---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
                                <p id="{{$descendant['deptName']}}_{{$descendant['meter_name']}}Date" >(Date Time)</p>
                            </h3>
                            <p>{{$descendant['deptName']}}</p>
                        </div>
                        {{--<div class="icon">--}}
                            {{--<i class="ion ion-pie-graph"></i>--}}
                        {{--</div>--}}
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection

@section('ownerOrDepartmentalGraph')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Graphics <i class="analysisType"></i></h3>
                <div class="box-tools pull-right">
                    {{--<span id="currentReadingHeading"></span> <b id="currentReadingText"></b>--}}
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {{--<p class="text-center">--}}
                    {{--<strong id="titleToGraph"></strong>--}}
                {{--</p>--}}
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li><a href="#donutChart" data-toggle="tab">Donut</a></li>
                        <li class="active"><a href="#barChart" data-toggle="tab">Bar</a></li>
                        {{--<li class="pull-left header"><i class="fa fa-inbox"></i>Sales</li>--}}
                    </ul>
                    <div class="tab-content no-padding" id="graphTabParent">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="barChart" style=" height: 400px; min-width: 200px"></div>
                        <div class="chart tab-pane" id="donutChart" align="center" style="height: 400px; min-width: 200px"><h3><i id="donutChartErrorMsg"></i></h3></div>
                    </div>
                </div>
                {{--<div id="chartContainer" style="height: 500px; min-width: 200px">--}}
                {{--</div><!-- /.chart-responsive -->--}}
            </div><!-- ./box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('ownerOrDepartmentalTable')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Table With Full Features</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date Time</th>
                    <th>Total Production</th>
                    @foreach($productionData['descendants'][\Carbon\Carbon::now()->format("Y-m-d")] as $descendant)
                        <th>{{$descendant['deptName']}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <?php echo $dataForTable;  ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Date Time</th>
                    <th>Total Production</th>
                    @foreach($productionData['descendants'][\Carbon\Carbon::now()->format("Y-m-d")] as $descendant)
                        <th>{{$descendant['deptName']}}</th>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection

@section('ownerOrDepartmentalScriptHeader')
<script type="text/javascript">
    $(function () {

//  =========================================Some Initial Code BELOW===========================================
        var productionData = <?php echo json_encode($productionData); ?>;
        var companyAndMeterNames = <?php echo json_encode($companyAndMeterNames); ?>;
        var date = moment().format("YYYY-MM-DD");
        var totalProduction = productionData['totalProduction'][date];
        var descendants = productionData['descendants'][date];
        var descendantsAll = productionData['descendants'];
        var totalProductionsAll = productionData['totalProduction'];
//        console.log("length is "+ Object.keys(totalProductionsAll).length);
        var parameterUnit = productionData['parameterUnit'];
        var i,j,k,l;
        var noDataTodayCounter = 0;
        var departmentProductionpercentage = Array();
        for(i=0;i<descendants.length;i++){
            if(descendants[i].value != 0)
                var percentageOfDescendant = parseFloat(descendants[i].value) / parseFloat(totalProduction.data)*100;
            else
                noDataTodayCounter++;
            departmentProductionpercentage.push({'deptName':descendants[i].deptName,'percentage':percentageOfDescendant});
        }

//  =========================================Some Initial Code FINISH===========================================




//  =========================================Tiles Initialization Code BELOW===========================================
//        --------------------initializing parameter unit elements---------------------
        window.onload = unitElements();
        function unitElements(){
            var allTilesParaUnits = document.getElementsByClassName("parameterUnit");
            for($k=0;$k<allTilesParaUnits.length;$k++){
                allTilesParaUnits[$k].innerHTML = parameterUnit.value;
            }
        }

//        --------------------setting totalProduction Tile to initial value---------------------
        var totalProductionValue = totalProduction.data;
        var totalProductionDateValue = totalProduction.dateTime;
        totalProductionDateValue = "(" +moment(totalProductionDateValue).format("ddd, MMM DD, HH:mm:ss")+")";
        displayMainTilesElementById(totalProductionValue,totalProductionDateValue);

//        --------------------initializing descendant tiles---------------------
        for(i=0;i<descendants.length;i++){
            var tileIdOfDescendants = descendants[i].deptName + "_"+descendants[i].meter_name;
            var tileValueOfDescendants = descendants[i].value;
            var tileDateIdOfDescendants = tileIdOfDescendants+"Date";
            var tileDateValueOfDescendants = descendants[i].dateTime;
            tileDateValueOfDescendants = "(" +moment(tileDateValueOfDescendants).format("ddd, MMM DD, HH:mm:ss")+")";
            displayDescendantTilesElementById(tileIdOfDescendants,tileValueOfDescendants,tileDateIdOfDescendants,tileDateValueOfDescendants)
        }

//  =========================================Tiles Initialization Code FINISH===========================================




//  =========================================Tiles LIVE Code BELOW===========================================
    setInterval(function () {
        var liveTileValue;

        liveTileValue = $.ajax({
            type: "GET",
            cache: false,
            url: "/liveData/"+companyAndMeterNames.assocId,
//									data: idOfCurrentMeter,
            async: false
        }).success(function(){
            setTimeout(function(){get_ajax_success();}, 500);
        }).responseText;
//        document.write("<br>feedback is " + liveTileValue  );
        function get_ajax_success() {
            if(liveTileValue != ""){
                liveTileValue = JSON.parse(liveTileValue);
                var totalProduction = liveTileValue['totalProduction'][date];
                var descendants = liveTileValue['descendants'][date];

        //        --------------------setting totalProduction Tile to LIVE value---------------------
                var totalProductionValue = totalProduction.data;
                var totalProductionDateValue = totalProduction.dateTime;
                totalProductionDateValue = "(" +moment(totalProductionDateValue).format("ddd, MMM DD, HH:mm:ss")+")";
                displayMainTilesElementById(totalProductionValue,totalProductionDateValue);

        //        --------------------initializing descendant tiles with LIVE values---------------------
                for(i=0;i<descendants.length;i++){
                    var tileIdOfDescendants = descendants[i].deptName + "_"+descendants[i].meter_name;
                    var tileValueOfDescendants = descendants[i].value;
                    var tileDateIdOfDescendants = tileIdOfDescendants+"Date";
                    var tileDateValueOfDescendants = descendants[i].dateTime;
                    tileDateValueOfDescendants = "(" +moment(tileDateValueOfDescendants).format("ddd, MMM DD, HH:mm:ss")+")";
//                    console.log(tileIdOfDescendants+": "+tileValueOfDescendants+" & "+tileDateIdOfDescendants+": "+tileDateValueOfDescendants);
                    displayDescendantTilesElementById(tileIdOfDescendants,tileValueOfDescendants,tileDateIdOfDescendants,tileDateValueOfDescendants)
                }
            }
        }
    },3000);

//  =========================================Tiles LIVE Code FINISH===========================================




        $(document).ready(function () {

//  =========================================Donut Chart Code BELOW===========================================
            // Build the chart
            if(noDataTodayCounter == 0){

                var chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'donutChart',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: true,
                        type: 'pie'
                    },
                    title: {
                        text: 'Departmental Analysis'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.2f}% </b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: "Departments",
                        colorByPoint: true,
                        data: (function () {
                            var data=[];
                            for(j=0;j<departmentProductionpercentage.length;j++){
                                data.push({'name': departmentProductionpercentage[j].deptName, 'y': departmentProductionpercentage[j].percentage});
                            }
                            return data;
                        }())
                    }]
                });

                var chartTabWidth = $('#donutChart').width();
                console.log("chartWidth: "+chartTabWidth);
                    chart.setSize($('#donutChart').width(),400);
//                    chart.reflow();
//                chart.setSize(400,400);

            }
            else
                setElementById("donutChartErrorMsg","No data found for today!")

//  =========================================Donut Chart Code FINISH===========================================


    Highcharts.setOptions({
        lang: {
            drillUpText: 'Back'
        }
    });

    //  =========================================Bar Chart Code BELOW===========================================
        // Create the chart
            $('#barChart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Last 7 days analysis'
                },
                subtitle: {
                    text: 'Click the columns to view departmental bar charts.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total Production'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'+parameterUnit.value
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}'+parameterUnit.value+'</b><br/>',
                    followPointer: true
                },

                series: [{
                    name: "Last 7 Days Analysis",
                    colorByPoint: true,
                    data:( function () {
                         var data=[];
                         var nameValue,yValue,drillDownValue;
                         var lengthOftotalProductionsAll = Object.keys(totalProductionsAll).length;
                         for(j=0;j<lengthOftotalProductionsAll;j++){
                            nameValue =  moment(totalProductionsAll[moment().subtract(j,'days').format("YYYY-MM-DD")].dateTime).format("YYYY-MM-DD");
                            yValue = parseFloat(totalProductionsAll[moment().subtract(j,'days').format("YYYY-MM-DD")].data);
                            drillDownValue = nameValue;
                            data.push({'name':nameValue, 'y':yValue, 'drilldown': drillDownValue});
                         }
                         return data;
                    }())
                }],

                drilldown: {
                    relativeTo: 'spacingBox',
                    position: {
                        y: 0,
                        x: 0
                    },
                    series:
                    (function () {
                         var data=[];
                         var seriesArr=[];
                         var nameValue,idValue;
                         var currentScanningDate;
                         var lengthOfDescendantsAll = Object.keys(descendantsAll).length
                         for(j=0;j<lengthOfDescendantsAll;j++){
                            currentScanningDate = descendantsAll[moment().subtract(j,'days').format("YYYY-MM-DD")];
                            nameValue =  moment(currentScanningDate[j].dateTime).format("YYYY-MM-DD");
                            idValue = nameValue;
                            for(k=0;k<currentScanningDate.length;k++){
                                data.push([
                                    currentScanningDate[k].deptName,
                                    parseFloat(currentScanningDate[k].value)
                                ]);
                            }
                            seriesArr.push({'name':nameValue, 'id':idValue, 'data': data});
                            data = [];
                         }
                         return seriesArr;
                    }())
                }
            });
        });
    });
//  =========================================Bar Chart Code FINISH===========================================













//  =========================================Some Other JS Functions BELOW===========================================
    function displayMainTilesElementById(totalProductionValue,totalProductionDateValue){
        setElementById("totalProduction",totalProductionValue);
        setElementById("totalProductionDate",totalProductionDateValue);

    }
    function displayDescendantTilesElementById(tileId,tileValue,tileDateId,tileDateValue){
        setElementById(tileId,tileValue);
        setElementById(tileDateId,tileDateValue);
    }

    function setElementById(elementId,elementValue){
        window.onload = settingElements();
        function settingElements() {
            document.getElementById(elementId).innerHTML = elementValue;
        }
    }

//  =========================================Some Other JS Functions FINISH===========================================
</script>
@endsection