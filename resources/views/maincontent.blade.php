@extends('pages.dashboard')

@section('contentFourBox')

		<div class=" pull-right">

				<div id="remote">
					{!! Form::open(array('url'=>'searchResult','method'=>'POST', 'files'=>true)) !!}
					{!! Form::text('searchBox',null,array('placeholder' => 'Search','id'=>'inputSuccess', 'class' => 'form-control typeahead input-lg')) !!}
					{{--{!! Form::submit('Search', array('class'=>'btn btn-primary')) !!}--}}
					{!!Form::close()!!}
				</div></div>

		<h3><b>{{$companyAndMeterNames[0]['companyName']}} >>> {{$companyAndMeterNames[0]['meterName']}}</b></h3>


		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Overall Statistics</h3>

				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
				{{--<- Live data Here ->--}}
				<!-- Small boxes (Stat box) -->
				<div class="row">
					<div class="col-lg-3 col-xs-12 col-sm-6 ">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3>
								    <b id="currentValue">---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
								    <p id="currentValueDate">(Date Time)</p>
                                </h3>

								{{--<p>Current Value &nbsp;&nbsp;₹<b id="currentValue">000</b></p>--}}
								<p>Current Readings</p>
							</div>
							<div class="icon">
								<i class="ion ion-speedometer"></i>
							</div>
						</div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-12 col-sm-6">
						<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
								<h3>
								    <b id="maximumValue">---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
								    <p id="maximumValueDate">(Date Time)</p>
								</h3>

								<p>Maximum</p>
							</div>
							<div class="icon">
								<i class="ion ion-flash"></i>
							</div>
						</div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-12 col-sm-6">
						<!-- small box -->
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3>
								    <b id="averageValue">---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
                                    <p id="averageValueDate">(Start Time) to (Current Time)</p>
                                </h3>
								<p>Average</p>
							</div>
							<div class="icon">
								<i class="ion ion-speedometer"></i>
							</div>
						</div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-12 col-sm-6">
						<!-- small box -->
						<div class="small-box bg-red">
							<div class="inner">
								<h3>
								    <b id="minimumValue">---</b><sup style="font-size: 20px" class="parameterUnit">---</sup>
								    <p id="minimumValueDate">(Date Time)</p>
                                </h3>
								<p>Minimum</p>
							</div>
							<div class="icon">
								<i class="ion ion-thermometer"></i>
							</div>
						</div>
					</div><!-- ./col -->
				</div><!-- /.row -->
				<i id="startTimeEndTime"></i>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
@endsection
@section('contentLiveGraph')
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Graphics</h3>
					<div class="box-tools pull-right">
                        {{--<div class="btn-group">--}}
                            {{--<button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li><a href="/home?pname=power">Power</a></li>--}}
                                {{--<li><a href="/home?pname=electricity">Electricity</a></li>--}}
                                {{--<li><a href="/home?pname=production">Production</a></li>--}}
                                {{--<li><a href="/home?pname=water">Water Flow</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        <span>Current Reading: </span> <b id="currentReadingText"></b>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						{{--<div class="btn-group">--}}
							{{--<button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>--}}
							{{--<ul class="dropdown-menu" role="menu">--}}
								{{--<li><a href="#">Last shift</a></li>--}}
								{{--<li><a href="#">yesterday</a></li>--}}
								{{--<li><a href="#">Previos month</a></li>--}}
								{{--<li class="divider"></li>--}}
								{{--<li><a href="#">Custom date</a></li>--}}
							{{--</ul>--}}
						{{--</div>--}}
						{{--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
							<p class="text-center">
								<strong id="titleToGraph"></strong>
							</p>
							<div id="chartContainer" style="height: 300px; min-width: 200px">
							</div><!-- /.chart-responsive -->
				</div><!-- ./box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
@endsection
@section('contentDataTable')
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
@section('contentLiveGraphHead')
	<script type="text/javascript">
		$(function () {
			var datePreviouslyTaken,dateCheck=0,dateCurrentOne;
			var twoDimensionalFeedback = <?php echo json_encode($dataForPreviousValues); ?>;
			{{----}}
//                    document.writeln(feedback);
//			console.log("Feedback[0] is - "+feedback['a'][0].unit);
            var feedback = twoDimensionalFeedback['data'];
            var parameterOfCurrentMeter = twoDimensionalFeedback['parameter'][0].unit;
            var parameterIdOfCurrentMeter = twoDimensionalFeedback['parameter'][0].id;
//            console.log("parameeter is "+parameterOfCurrentMeter)
			var feedbackLength = feedback.length;
			datePreviouslyTaken = Date.createFromMysql(feedback[feedbackLength - 1].DateTime);
//			console.log("Date - "+datePreviouslyTaken);
			var arrayOfValuesOfCurrentMeter = new Array();
			var diffArrayForParameterOne = new Array();
            if(parameterIdOfCurrentMeter == 1){
                for($i=1;$i<feedbackLength;$i++){
                    arrayOfValuesOfCurrentMeter.push(parseFloat(parseFloat(feedback[$i].value) - parseFloat(feedback[$i - 1].value)).toFixed(2));
//                    document.writeln("<br/>array for str["+($i-1)+"] is " + arrayOfValuesOfCurrentMeter[$i-1]);
                }
            }
            else{
                for($i=0;$i<feedbackLength;$i++){
                    arrayOfValuesOfCurrentMeter.push(parseFloat(feedback[$i].value));
//                    document.writeln("<br/>array for spd is " + arrayOfValuesOfCurrentMeter[$i]);
                }
			}
			var maximumIndexFromPrevious = indexOfMax(arrayOfValuesOfCurrentMeter);
			var minimumIndexFromPrevious = indexOfMin(arrayOfValuesOfCurrentMeter);
            //Folowing is to initialize HTML elements with particular ids, so as to prevent error!

            window.onload = unitElements();
            function unitElements(){
                var allTilesParaUnits = document.getElementsByClassName("parameterUnit");
                for($k=0;$k<allTilesParaUnits.length;$k++){
                    allTilesParaUnits[$k].innerHTML = parameterOfCurrentMeter;
                }
            }



            if(parameterIdOfCurrentMeter == 1){
                window.onload = currentReadingElements();
                function currentReadingElements(){
                        document.getElementById("currentReadingText").innerHTML = parseFloat(feedback[feedback.length - 1].value).toFixed(2);
                }
                var currValue = parseFloat(arrayOfValuesOfCurrentMeter[arrayOfValuesOfCurrentMeter.length - 1]);
                var currValueDate = "(" +moment(feedback[feedback.length - 1].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                var maxValue = parseFloat(arrayOfValuesOfCurrentMeter[maximumIndexFromPrevious]);
                var maxValueDate = "("+moment(feedback[maximumIndexFromPrevious+1].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                var minValue = parseFloat(arrayOfValuesOfCurrentMeter[minimumIndexFromPrevious]);
                var minValueDate = "("+moment(feedback[minimumIndexFromPrevious+1].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                var avgValue = averageOfArray(arrayOfValuesOfCurrentMeter);
                var startTimeToEndTime = "*<b><u>Start Time</u> - </b>"+moment(feedback[0].DateTime).format("ddd, MMM DD, HH:mm:ss")+"<b> &nbsp;&nbsp;<u>and Current Time</u> - </b>"+moment(feedback[feedback.length - 1].DateTime).format("ddd, MMM DD, HH:mm:ss") ;
                var titleOfGraph = moment(feedback[0].DateTime).format("dddd, MMM DD, HH:mm:ss") + "&nbsp; to &nbsp;" + moment(feedback[feedback.length - 1].DateTime).format("dddd, MMM DD, HH:mm:ss") ;
                displayElementById(currValue,currValueDate,maxValue,maxValueDate,minValue,minValueDate,avgValue,startTimeToEndTime,titleOfGraph);
            }else{
                currValue = parseFloat(feedback[feedbackLength-1].value);
                currValueDate = "(" +moment(feedback[feedback.length - 1].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                maxValue = parseFloat(feedback[maximumIndexFromPrevious].value);
                maxValueDate = "("+moment(feedback[maximumIndexFromPrevious].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                minValue = parseFloat(feedback[minimumIndexFromPrevious].value);
                minValueDate = "("+moment(feedback[minimumIndexFromPrevious].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                avgValue = averageOfArray(arrayOfValuesOfCurrentMeter);
                startTimeToEndTime = "*<b><u>Start Time</u> - </b>"+moment(feedback[0].DateTime).format("ddd, MMM DD, HH:mm:ss")+"<b> &nbsp;&nbsp;<u>and Current Time</u> - </b>"+moment(feedback[feedback.length - 1].DateTime).format("ddd, MMM DD, HH:mm:ss") ;
                titleOfGraph = moment(feedback[0].DateTime).format("dddd, MMM DD, HH:mm:ss") + "&nbsp; to &nbsp;" + moment(feedback[feedback.length - 1].DateTime).format("dddd, MMM DD, HH:mm:ss") ;
                displayElementById(currValue,currValueDate,maxValue,maxValueDate,minValue,minValueDate,avgValue,startTimeToEndTime,titleOfGraph);
            }


//            document.writeln("<br/>data is <br/>"+feedback[0].DateTime);
                /*===============Multiparameter code... requires changes as ported to table 'data' .... that's why commented for now [10-4-16]===========
			var parameterName = "kWH";
			//Following will check if URL parameter exits or not.
			var field = 'pname';
			var url = window.location.href;
			if(url.indexOf('?' + field + "=power") != -1 || url.indexOf('&' + field + "=power") != -1) {
				parameterName = "kWH";
			}
			else if(url.indexOf('?' + field + "=electricity") != -1 || url.indexOf('&' + field + "=electricity") != -1) {
				parameterName = "ampere";
			}
			else if(url.indexOf('?' + field + "=production") != -1 || url.indexOf('&' + field + "=production") != -1) {
				parameterName = "degreeC";
			}
			else if(url.indexOf('?' + field + "=water") != -1 || url.indexOf('&' + field + "=water") != -1) {
				parameterName = "bar";
			}
			else
				parameterName = "kWH";
			//document.writeln(feedback[1].kWH);
			*/

			Highcharts.setOptions({
				global : {
					useUTC : false
				}
			});
			// Create the chart
			$('#chartContainer').highcharts('StockChart', {
				chart : {
					events : {
						load : function () {
							// set up the updating of the chart each second
							var series = this.series[0];
							setInterval(function () {
								var feedbackLive ;
								var idOfCurrentMeter = feedback[0].meter_id;
								feedbackLive = $.ajax({
									type: "POST",
									cache: false,
									url: "/liveGraphValues/"+idOfCurrentMeter,
//									data: idOfCurrentMeter,
									async: false
								}).success(function(){
									setTimeout(function(){get_fb_success();}, 500);
								}).responseText;
//								document.write("<br>feedback is " + feedbackLive  );
								function get_fb_success() {
									if(feedbackLive != "[]")
									{
										feedbackLive = JSON.parse(feedbackLive);
										var graphJSONincrementer = 0;

                /*================Tiles Code... requires changes as ported to table 'data' .... that's why commented for now [10-4-16]================
										//Folowing is to initialize HTML elements with particular ids, so as to prevent error!
										window.onload = settingElements();
										function settingElements() {
											document.getElementById("kwh").innerHTML = parseFloat(feedbackLive[graphJSONincrementer].kWH);
											document.getElementById("ampere").innerHTML = parseFloat(feedbackLive[graphJSONincrementer].ampere);
											document.getElementById("degreeC").innerHTML = parseFloat(feedbackLive[graphJSONincrementer].degreeC);
											document.getElementById("bar").innerHTML = parseFloat(feedbackLive[graphJSONincrementer].bar);
											document.getElementById("kwhMoney").innerHTML = (parseFloat(feedbackLive[graphJSONincrementer].kWH)*6.986).toFixed(2);
										}*/
//										document.write("<br>feedback is " + feedbackLive[graphJSONincrementer].DateTime  );
//										document.write("<br>feedback is " + feedbackLive[graphJSONincrementer].value  );
//										document.write("<br>feedback is " + Number(feedbackLive[graphJSONincrementer].value)  );
//
//                                        console.log("graphJSONIncrementer is - "+graphJSONincrementer + " for - "+feedbackLive[graphJSONincrementer].DateTime);
										//Following will check, if value is missed or not with the help of date... If missed then the page will be reloaded.
										dateCurrentOne = Date.createFromMysql(feedbackLive[graphJSONincrementer].DateTime);
										var subDate = dateCurrentOne - datePreviouslyTaken;
										if(subDate <15500)  {
                /*====================MultiParameter Code.... requires changes as ported to table 'data' .... that's why commented for now [10-4-16]============

											if(parameterName == "kWH") {
												var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime)), // current time
														y = feedbackLive[graphJSONincrementer].kWH;
											} else if(parameterName == "ampere") {
												var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime)), // current time
														y = feedbackLive[graphJSONincrementer].ampere;
											} else if(parameterName == "degreeC") {
												var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime)), // current time
														y = feedbackLive[graphJSONincrementer].degreeC;
											} else if(parameterName == "bar") {
												var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime)), // current time
														y = feedbackLive[graphJSONincrementer].bar;
											}
											*/
//											console.log("feedback[length] - "+feedback[feedbackLength-1].DateTime);
//                                            feedback.push({"id":feedbackLive[graphJSONincrementer].id,"meter_id":feedbackLive[graphJSONincrementer].meter_id,"parameter_id":feedbackLive[graphJSONincrementer].parameter_id,"value":feedbackLive[graphJSONincrementer].value,"DateTime":feedbackLive[graphJSONincrementer].DateTime});
                                            if(feedback[feedback.length - 1].DateTime != feedbackLive[graphJSONincrementer].DateTime){
                                                feedback.push(feedbackLive[graphJSONincrementer]);
    //                                            console.log("feedback[length] - "+feedback[feedback.length-1].DateTime);

                                                if(parameterIdOfCurrentMeter == 1)
                                                    arrayOfValuesOfCurrentMeter.push(parseFloat(parseFloat(feedback[feedback.length-1].value) -  parseFloat(feedback[feedback.length-2].value)).toFixed(2));
                                                else
                                                    arrayOfValuesOfCurrentMeter.push(parseFloat(feedback[feedback.length-1].value));

                                                var maximumIndexLive = indexOfMax(arrayOfValuesOfCurrentMeter);
                                                var minimumIndexLive = indexOfMin(arrayOfValuesOfCurrentMeter);

                                                if(parameterIdOfCurrentMeter == 1){
                                                    currValue = parseFloat(arrayOfValuesOfCurrentMeter[arrayOfValuesOfCurrentMeter.length - 1]);
                                                    currValueDate = "(" +moment(feedback[feedback.length - 1].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                                                    maxValue = parseFloat(arrayOfValuesOfCurrentMeter[maximumIndexLive]);
                                                    maxValueDate = "("+moment(feedback[maximumIndexLive+1].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                                                    minValue = parseFloat(arrayOfValuesOfCurrentMeter[minimumIndexLive]);
                                                    minValueDate = "("+moment(feedback[minimumIndexLive+1].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                                                    avgValue = averageOfArray(arrayOfValuesOfCurrentMeter);
                                                    startTimeToEndTime = "*<b><u>Start Time</u> - </b>"+moment(feedback[0].DateTime).format("ddd, MMM DD, HH:mm:ss")+"<b> &nbsp;&nbsp;<u>and Current Time</u> - </b>"+moment(feedback[feedback.length - 1].DateTime).format("ddd, MMM DD, HH:mm:ss") ;
                                                    titleOfGraph = moment(feedback[0].DateTime).format("dddd, MMM DD, HH:mm:ss") + "&nbsp; to &nbsp;" + moment(feedback[feedback.length - 1].DateTime).format("dddd, MMM DD, HH:mm:ss") ;
                                                    displayElementById(currValue,currValueDate,maxValue,maxValueDate,minValue,minValueDate,avgValue,startTimeToEndTime,titleOfGraph);
                                                    var x = Number(Date.createFromMysql(feedback[feedback.length - 1].DateTime)), // current time
                                                        y = parseFloat(arrayOfValuesOfCurrentMeter[arrayOfValuesOfCurrentMeter.length - 1]);
                                                    series.addPoint([x, y], true, true);
                                                }else{
                                                    currValue = parseFloat(feedback[feedback.length-1].value);
                                                    currValueDate = "(" +moment(feedback[feedback.length - 1].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                                                    maxValue = parseFloat(feedback[maximumIndexLive].value);
                                                    maxValueDate = "("+moment(feedback[maximumIndexLive].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                                                    minValue = parseFloat(feedback[minimumIndexLive].value);
                                                    minValueDate = "("+moment(feedback[minimumIndexLive].DateTime).format("ddd, MMM DD, HH:mm:ss")+")";
                                                    avgValue = averageOfArray(arrayOfValuesOfCurrentMeter);
                                                    startTimeToEndTime = "*<b><u>Start Time</u> - </b>"+moment(feedback[0].DateTime).format("ddd, MMM DD, HH:mm:ss")+"<b> &nbsp;&nbsp;<u>and Current Time</u> - </b>"+moment(feedback[feedback.length - 1].DateTime).format("ddd, MMM DD, HH:mm:ss") ;
                                                    titleOfGraph = moment(feedback[0].DateTime).format("dddd, MMM DD, HH:mm:ss") + "&nbsp; to &nbsp;" + moment(feedback[feedback.length - 1].DateTime).format("dddd, MMM DD, HH:mm:ss") ;
                                                    displayElementById(currValue,currValueDate,maxValue,maxValueDate,minValue,minValueDate,avgValue,startTimeToEndTime,titleOfGraph);
                                                    var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].DateTime)), // current time
                                                        y = Number(feedbackLive[graphJSONincrementer].value);
                                                    series.addPoint([x, y], true, true);
                                                }
											}
											graphJSONincrementer++;
											datePreviouslyTaken = dateCurrentOne;
										}
										else
											location.reload();
									}
								}}, 3000);
						}
					}
				},

				rangeSelector: {
					buttons: [{
						count: 1,
						type: 'minute',
						text: '1M'
					}, {
						count: 5,
						type: 'minute',
						text: '5M'
					}, {
						count: 30,
						type: 'minute',
						text: '30M'
					}, {
						count: 1,
						type: 'hour',
						text: '1H'
					}, {
						count: 3,
						type: 'hour',
						text: '3H'
					},{
						count: 6,
						type: 'hour',
						text: '6H'
					}, {
						type: 'sll',
						text: 'ALL'
					}],
					inputEnabled: true,
					selected: 1
				},
//                rangeSelector: {
//                    selected: 1
//                },
				title : {
					text : ''
				},

                navigation: {
                    buttonOptions: {

                    },
                    menuItemStyle: {
                        fontSize: '15px'
                    }
                },

                tooltip: {
                    valueSuffix: parameterOfCurrentMeter
                },
				exporting: {
					enabled: true

				},

				series : [{
					name : 'Value',
					data : (function () {
						// generate graph for previousData

            /*=================Tiles Code... requires changes as ported to table 'data' .... that's why commented for now [10-4-16]================
						window.onload = settingElements(); //Sets Tile values to the latest recent value
						function settingElements() {
							document.getElementById("kwh").innerHTML = parseFloat(feedback[feedbackLength - 1].kWH);
							document.getElementById("ampere").innerHTML = parseFloat(feedback[feedbackLength - 1].ampere);
							document.getElementById("degreeC").innerHTML = parseFloat(feedback[feedbackLength - 1].degreeC);
							document.getElementById("bar").innerHTML = parseFloat(feedback[feedbackLength - 1].bar);
							document.getElementById("kwhMoney").innerHTML = (parseFloat(feedback[feedbackLength - 1].kWH)*6.986).toFixed(2);
						}
						*/

						var data = [], j;
						//Pushes values/data to graph to display
						for (j=0; j<arrayOfValuesOfCurrentMeter.length ; j++) {
            /*==================Multiple Parameter code... requires changes as ported to table 'data' .... that's why commented for now [10-4-16]==============
							if(parameterName == "kWH") {
								data.push([
									Number(Date.createFromMysql(feedback[j].dateTime)),
									parseFloat(feedback[j].kWH)
								]);
							} else if(parameterName == "ampere") {
								data.push([
									Number(Date.createFromMysql(feedback[j].dateTime)),
									parseFloat(feedback[j].ampere)
								]);
							} else if(parameterName == "degreeC") {
								data.push([
									Number(Date.createFromMysql(feedback[j].dateTime)),
									parseFloat(feedback[j].degreeC)
								]);
							} else if(parameterName == "bar") {
								data.push([
									Number(Date.createFromMysql(feedback[j].dateTime)),
									parseFloat(feedback[j].bar)
								]);
							}
							*/
							if(parameterIdOfCurrentMeter == 1){
                                data.push([
                                    Number(Date.createFromMysql(feedback[j+1].DateTime)),
                                    parseFloat(arrayOfValuesOfCurrentMeter[j])
                                ]);
							} else {
                                data.push([
                                    Number(Date.createFromMysql(feedback[j].DateTime)),
                                    parseFloat(arrayOfValuesOfCurrentMeter[j])
                                ]);
                            }
						}
						return data;
					}())
				}]
			});

		});

		Date.createFromMysql = function(mysql_string)  //Converts SQL DateTime format to Javascript format.
		{
			if(typeof mysql_string === 'string')
			{
				var t = mysql_string.split(/[- :]/);
				return new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
			}
			return null;
		}

		function indexOfMax(arr) {
            if (arr.length === 0) {
                return -1;
            }
            var max = parseFloat(arr[0]);
//            console.log("start Max Value is "+max);
            var maxIndex = 0;
            for (var i = 1; i < arr.length; i++) {
//                console.log("arr["+i+"] - "+arr[i]);
                if (parseFloat(arr[i]) >= parseFloat(max)) {
                    maxIndex = i;
                    max = parseFloat(arr[i]);
                }
//                console.log("Current  "+max);

            }
//            console.log("end Max Value is at "+maxIndex + "and its value is "+arr[maxIndex]);
            return maxIndex;
        }

        function indexOfMin(arr) {
            if (arr.length === 0) {
                return -1;
            }
            var min = parseFloat(arr[0]);
            var minIndex = 0;
//            console.log("start Min Value is "+min);
            for (var i = 1; i < arr.length; i++) {
                if (parseFloat(arr[i]) <= parseFloat(min)) {
                    minIndex = i;
                    min = parseFloat(arr[i]);
                }

            }
//            console.log("end Min Value is at "+minIndex + "and its value is "+arr[minIndex]);
            return minIndex;
        }

        function averageOfArray(arr){
            var i=0;
            var sum =0;
            for(i=0;i<arr.length;i++){
//                console.log("<br/>:::::Array["+i+"] = "+arr[i]);
                sum += parseFloat(arr[i]);
            }
//            console.log("Last Array element is "+arr[arr.length-1]);
//            console.log("sum is "+sum);
            var avg = sum/arr.length;
//            console.log("Avg is "+avg.toFixed(2));
            return avg.toFixed(2);
        }

        function getTimeFromSqlDatTime(sqlDateTime){
            var d = new Date(Date.createFromMysql(sqlDateTime));
            var timeString = d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
//            console.log("Converted Time is" + timeString);
            return timeString;
        }


        function displayElementById(currentVal,currentValDate,maxVal,maxValDate,minVal,minValDate,avgVal,startTiEndTi,titleGraph){
            window.onload = settingElements();
            function settingElements() {
                document.getElementById("currentValue").innerHTML = currentVal;
                document.getElementById("currentValueDate").innerHTML = currentValDate;
                document.getElementById("maximumValue").innerHTML = maxVal;
                document.getElementById("maximumValueDate").innerHTML = maxValDate;
                document.getElementById("minimumValue").innerHTML = minVal;
                document.getElementById("minimumValueDate").innerHTML = minValDate;
                document.getElementById("averageValue").innerHTML = avgVal;
                document.getElementById("startTimeEndTime").innerHTML = startTiEndTi;
                document.getElementById("titleToGraph").innerHTML = titleGraph;
            }
        }

	</script>
@endsection