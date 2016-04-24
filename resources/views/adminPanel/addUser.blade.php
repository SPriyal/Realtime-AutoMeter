@extends('adminPanel.adminDashboard')

@section('content')


    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add User</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {{--<- Live data Here ->--}}
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-md-9 col-xs-12">

                    {!! Form::open(array('url'=>'adminPanel/adduser','method'=>'POST','class' => 'form-horizontal')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        {!! Form::label('inputName3', 'Name', array('class' => 'col-sm-3 control-label')); !!}
                        <div class="col-sm-9">
                            {!! Form::text('inputName3',null,array('placeholder' => 'Name', 'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('inputEmail3', 'E-Mail Address', array('class' => 'col-sm-3 control-label')); !!}
                        <div class="col-sm-9">
                            {!! Form::email('inputEmail3',null,array('placeholder' => 'Email id', 'class' =>'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('inputPassword3', 'Password', array('class' => 'col-sm-3 control-label')); !!}
                        <div class="col-sm-9">
                            {!! Form::password('inputPassword3',null,array('placeholder' => 'Password', 'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('inputAsso3', 'Association ID', array('class' => 'col-sm-3 control-label')); !!}
                        <div class="col-sm-9">
                            {!! Form::text('inputAsso3',null,array('placeholder' => 'Associative ID', 'class' => 'form-control')) !!}
                        </div>
                    </div>

                    {!! Form::submit('Submit', array('class'=>'btn btn-primary pull-right')) !!}

                    <p class="errors">{!!$errors->first('image')!!}</p>
                    @if(Session::has('error'))
                        <p class="errors">{!! Session::get('error') !!}</p>
                    @endif
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
    </div><!-- /.box -->
@endsection
