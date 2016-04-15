@extends('adminPanel.adminDashboard')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add Company</h3>
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
                </div><!-- ./col -->
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}&nbsp;&nbsp;&nbsp;Upload a CSV file.
            {!!Form::close()!!}
        </div>
    </div><!-- /.box -->
@endsection