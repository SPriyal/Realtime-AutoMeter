@extends('adminPanel.adminDashboard')

@section('content')

    {!! Form::open(array('url'=>'adminPanel/adduser','method'=>'POST')) !!}

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add User</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{--<- Live data Here ->--}}
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">

                    {!! Form::text('inputName3',null,array('placeholder' => 'Name', 'class' => 'form-control')) !!}
                    {!! Form::email('inputEmail3',null,array('placeholder' => 'Email id', 'class' => 'form-control')) !!}
                    {!! Form::password('inputPassword3',null,array('placeholder' => 'Password', 'class' => 'form-control')) !!}
                    {!! Form::text('inputAsso3',null,array('placeholder' => 'Associative ID', 'class' => 'form-control')) !!}


                    <p class="errors">{!!$errors->first('image')!!}</p>
                    @if(Session::has('error'))
                        <p class="errors">{!! Session::get('error') !!}</p>
                    @endif
                </div><!-- ./col -->
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
            {!!Form::close()!!}
        </div>
    </div><!-- /.box -->
@endsection
