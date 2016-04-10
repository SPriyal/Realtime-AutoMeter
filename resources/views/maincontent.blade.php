@extends('pages.dashboard')

@section('contentFourBox')

        <div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Admin Panel</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
				{{--<- Live data Here ->--}}
				<!-- Small boxes (Stat box) -->
				<div class="row">
					<div class="col-lg-3 col-xs-6">
                        {!! Form::open(array('url'=>'adminPanel/Process','method'=>'POST', 'files'=>true)) !!}
                        {!! Form::text('newCompanyName',null,array('placeholder' => 'Enter Company Name', 'class' => 'form-control')) !!}
                        <br/>
                        {!! Form::file('newCompanyCsvFile') !!}
                        <p class="errors">{!!$errors->first('image')!!}</p>
                        @if(Session::has('error'))
                        <p class="errors">{!! Session::get('error') !!}</p>
                        @endif
                        {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
                        {!!Form::close()!!}
					</div><!-- ./col -->
				</div><!-- /.row -->
			</div><!-- /.box-body -->
		</div><!-- /.box -->

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
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><b id="kwh">---</b><sup style="font-size: 20px">kWH</sup></h3>
								<p>Power &nbsp;&nbsp;₹<b id="kwhMoney">000</b></p>
							</div>
							<div class="icon">
								<i class="ion ion-speedometer"></i>
							</div>
						</div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
								<h3><b id="ampere">---</b><sup style="font-size: 20px">A</sup></h3>
								<p>Electricity</p>
							</div>
							<div class="icon">
								<i class="ion ion-flash"></i>
							</div>
						</div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><b id="degreeC">---</b><sup style="font-size: 20px">Unit</sup></h3>
								<p>Production</p>
							</div>
							<div class="icon">
								<i class="ion ion-speedometer"></i>
							</div>
						</div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-red">
							<div class="inner">
								<h3><b id="bar">---</b><sup style="font-size: 20px">Litre</sup></h3>
								<p>Water Flow</p>
							</div>
							<div class="icon">
								<i class="ion ion-thermometer"></i>
							</div>
						</div>
					</div><!-- ./col -->
				</div><!-- /.row -->
			</div><!-- /.box-body -->
		</div><!-- /.box -->
@endsection
@section('contentLiveGraph')
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Monthly Recap Report</h3>
					<div class="box-tools pull-right">
                        <div class="btn-group">
                            <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/home?pname=power">Power</a></li>
                                <li><a href="/home?pname=electricity">Electricity</a></li>
                                <li><a href="/home?pname=production">Production</a></li>
                                <li><a href="/home?pname=water">Water Flow</a></li>
                            </ul>
                        </div>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<div class="btn-group">
							<button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Last shift</a></li>
								<li><a href="#">yesterday</a></li>
								<li><a href="#">Previos month</a></li>
								<li class="divider"></li>
								<li><a href="#">Custom date</a></li>
							</ul>
						</div>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
							<p class="text-center">
								<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
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
			var feedback = <?php echo json_encode($dataForPreviousValues); ?>;
			{{----}}
//                    document.writeln(feedback);
			var feedbackLength = feedback.length;
			datePreviouslyTaken = Date.createFromMysql(feedback[feedbackLength - 1].DateTime);

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
								feedbackLive = $.ajax({
									type: "POST",
									cache: false,
									url: "/liveGraphValues",
									async: false
								}).success(function(){
									setTimeout(function(){get_fb_success();}, 500);
								}).responseText;
								document.write("<br>feedback is " + feedbackLive  );
								function get_fb_success() {
									if(feedbackLive != "[]")
									{
										feedbackLive = JSON.parse(feedbackLive);
										var graphJSONincrementer = 0;
                /*================Tiles Code... requires changes as ported to table 'data' .... that's why commented for now [10-4-16]================
										//Folowing is to initialize HTML elements with particular ids, so as to prevent error!
										window.onload = settingElements();
										function settingElements() {
											document.getElementById("kwh").innerHTML = parseInt(feedbackLive[graphJSONincrementer].kWH);
											document.getElementById("ampere").innerHTML = parseInt(feedbackLive[graphJSONincrementer].ampere);
											document.getElementById("degreeC").innerHTML = parseInt(feedbackLive[graphJSONincrementer].degreeC);
											document.getElementById("bar").innerHTML = parseInt(feedbackLive[graphJSONincrementer].bar);
											document.getElementById("kwhMoney").innerHTML = (parseInt(feedbackLive[graphJSONincrementer].kWH)*6.986).toFixed(2);
										}*/
										document.write("<br>feedback is " + feedbackLive.DateTime  );
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
                                            var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].DateTime)), // current time
                                                y = feedbackLive[graphJSONincrementer].value;
											series.addPoint([x, y], true, true);
											graphJSONincrementer++;
											datePreviouslyTaken = dateCurrentOne;
										}
										else
											location.reload();
									}
								}}, 4000);
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
					inputEnabled: false,
					selected: 1
				},

				title : {
					text : ''
				},

				exporting: {
					enabled: false
				},

				series : [{
					name : 'Test',
					data : (function () {
						// generate graph for previousData

            /*=================Tiles Code... requires changes as ported to table 'data' .... that's why commented for now [10-4-16]================
						window.onload = settingElements(); //Sets Tile values to the latest recent value
						function settingElements() {
							document.getElementById("kwh").innerHTML = parseInt(feedback[feedbackLength - 1].kWH);
							document.getElementById("ampere").innerHTML = parseInt(feedback[feedbackLength - 1].ampere);
							document.getElementById("degreeC").innerHTML = parseInt(feedback[feedbackLength - 1].degreeC);
							document.getElementById("bar").innerHTML = parseInt(feedback[feedbackLength - 1].bar);
							document.getElementById("kwhMoney").innerHTML = (parseInt(feedback[feedbackLength - 1].kWH)*6.986).toFixed(2);
						}
						*/

						var data = [], i;
						//Pushes values/data to graph to display
						for (i = -(feedbackLength-1),j=0; i <= 0 ; i += 1,j++) {
            /*==================Multiple Parameter code... requires changes as ported to table 'data' .... that's why commented for now [10-4-16]==============
							if(parameterName == "kWH") {
								data.push([
									Number(Date.createFromMysql(feedback[j].dateTime)),
									parseInt(feedback[j].kWH)
								]);
							} else if(parameterName == "ampere") {
								data.push([
									Number(Date.createFromMysql(feedback[j].dateTime)),
									parseInt(feedback[j].ampere)
								]);
							} else if(parameterName == "degreeC") {
								data.push([
									Number(Date.createFromMysql(feedback[j].dateTime)),
									parseInt(feedback[j].degreeC)
								]);
							} else if(parameterName == "bar") {
								data.push([
									Number(Date.createFromMysql(feedback[j].dateTime)),
									parseInt(feedback[j].bar)
								]);
							}
							*/
							data.push([
                                Number(Date.createFromMysql(feedback[j].DateTime)),
                                parseInt(feedback[j].value)
                            ]);
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
	</script>
@endsection