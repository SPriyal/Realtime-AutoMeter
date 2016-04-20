@extends('adminPanel.adminDashboard')

@section('content')


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
                <div class="col-lg-6 col-md-9 col-xs-12">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('adminPanel/adduser') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="inputName3" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName3" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAsso3" class="col-sm-3 control-label">Association ID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputAsso3" placeholder="Access Id number">
                            </div>
                        </div>
                        {!! Form::submit('Submit', array('class'=>'btn btn-primary pull-right')) !!}

                    </form>


                    <p class="errors">{!!$errors->first('image')!!}</p>
                    @if(Session::has('error'))
                        <p class="errors">{!! Session::get('error') !!}</p>
                    @endif
                </div><!-- ./col -->
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div>
    </div><!-- /.box -->
@endsection
