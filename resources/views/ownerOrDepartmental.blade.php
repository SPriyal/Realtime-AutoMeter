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
            @foreach($productionData['descendants'] as $descendant)
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
                        <li><a href="#barChart" data-toggle="tab">Bar</a></li>
                        <li class="active"><a href="#donutChart" data-toggle="tab">Donut</a></li>
                        {{--<li class="pull-left header"><i class="fa fa-inbox"></i>Sales</li>--}}
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="donutChart" style="height: 400px; min-width: 200px"></div>
                        <div class="chart tab-pane" id="barChart" style="height: 400px; min-width: 200px"></div>
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
                    <th>Number</th>
                    <th>Parameter Name</th>
                    <th>Value</th>
                    <th>DateTime</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $dataForTable;  ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Number</th>
                    <th>Parameter Name</th>
                    <th>Value</th>
                    <th>DateTime</th>
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
        var totalProduction = productionData['totalProduction'];
        var descendants = productionData['descendants'];
        var parameterUnit = productionData['parameterUnit'];
        var i,j,k,l;
//  =========================================Some Initial Code FINISH===========================================




//  =========================================Tiles Initialization Code BELOW===========================================
        window.onload = unitElements();
        function unitElements(){
            var allTilesParaUnits = document.getElementsByClassName("parameterUnit");
            for($k=0;$k<allTilesParaUnits.length;$k++){
                allTilesParaUnits[$k].innerHTML = parameterUnit.value;
            }
        }

        var totalProductionValue = totalProduction.data;
        console.log("totalProduction is "+totalProductionValue);
        var totalProductionDateValue = totalProduction.dateTime;
        totalProductionDateValue = "(" +moment(totalProductionDateValue).format("ddd, MMM DD, HH:mm:ss")+")";
        displayMainTilesElementById(totalProductionValue,totalProductionDateValue);

        for(i=0;i<descendants.length;i++){
            var tileIdOfDescendants = descendants[i].deptName + "_"+descendants[i].meter_name;
            var tileValueOfDescendants = descendants[i].value;
            var tileDateIdOfDescendants = tileIdOfDescendants+"Date";
            var tileDateValueOfDescendants = descendants[i].dateTime;
            tileDateValueOfDescendants = "(" +moment(tileDateValueOfDescendants).format("ddd, MMM DD, HH:mm:ss")+")";
            displayDescendantTilesElementById(tileIdOfDescendants,tileValueOfDescendants,tileDateIdOfDescendants,tileDateValueOfDescendants)
        }

//  =========================================Tiles Initialization Code FINISH===========================================



//  =========================================Donut Chart Code BELOW===========================================
        $(document).ready(function () {

            // Build the chart
            $('#donutChart').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Browser market shares January, 2015 to May, 2015'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                    name: "Brands",
                    colorByPoint: true,
                    data: [{
                        name: "Microsoft Internet Explorer",
                        y: 56.33
                    }, {
                        name: "Chrome",
                        y: 24.030000000000005,
                        sliced: true,
                        selected: true
                    }, {
                        name: "Firefox",
                        y: 10.38
                    }, {
                        name: "Safari",
                        y: 4.77
                    }, {
                        name: "Opera",
                        y: 0.9100000000000001
                    }, {
                        name: "Proprietary or Undetectable",
                        y: 0.2
                    }]
                }]
            });
        });
    });
//  =========================================Donut Chart Code FINISH===========================================




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