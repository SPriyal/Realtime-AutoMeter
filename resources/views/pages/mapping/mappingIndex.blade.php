<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Mapping</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        {{--<- Live data Here ->--}}
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                {!! Form::open(array('url'=>'mapping/Selection','method'=>'POST', 'files'=>true)) !!}
                {{--{!! Form::select('companiesList',$companyNameList,$companyIdList,$companyIdList) !!}--}}
                {{--{!! Form::select('companiesList',array($companyIdList => $companyNameList)) !!}--}}
                <select id="companiesListID" class="dropdown-menu" name="companiesList">
                    @foreach($companyList as $company)
                        <option value="{{$company}}">{{$company}}</option>
                    @endforeach
                </select>
                <br/>
                {!! Form::submit('Next', array('class'=>'btn btn-primary')) !!}
                {!!Form::close()!!}
            </div><!-- ./col -->
        </div><!-- /.row -->
    </div><!-- /.box-body -->
</div><!-- /.box -->