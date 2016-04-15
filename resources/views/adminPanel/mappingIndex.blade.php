@extends('adminPanel.adminDashboard')

@section('content')
<div class="box box-info" xmlns="http://www.w3.org/1999/html">
    <div class="box-header with-border">
        <h3 class="box-title">Mapping</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12 ">
                <p>&nbsp; Select the company to map the CSV file and press Next</p>
                {!! Form::open(array('url'=>'metermapping/Selection','method'=>'POST', 'files'=>true)) !!}
                <select id="companiesListID" class="form-control" name="companiesList">
                    @foreach($companyList as $company)
                        <option value="{{$company}}">{{$company}}</option>
                    @endforeach
                </select>
            </div><!-- ./col -->
        </div><!-- /.row -->
    </div><!-- /.box-body -->
    <div class="box-footer">
        {!! Form::submit('Next', array('class'=>'btn btn-primary')) !!}
        {!!Form::close()!!}
    </div>
</div><!-- /.box -->
@endsection