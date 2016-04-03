@extends('pages.dashboard')

@section('content')

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

{{--                        MONTHLY RECAP REPORT CODE STARTS HERE                       --}}
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
                </div><!-- /.col -->
              </div><!-- /.row -->
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->

@endsection