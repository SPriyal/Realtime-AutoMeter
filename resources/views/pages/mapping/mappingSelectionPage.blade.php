<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Mapping for {{$selectedCompany}}</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        {{--<- Live data Here ->--}}
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                {!! Form::open(array('url'=>'mapping/Selection/Submit','method'=>'POST', 'files'=>true)) !!}
                <table>
                    @for($i=0;$i<sizeof($meterIdListForSelectedCompany);$i++)
                        <tr>
                            <td>{!! Form::label($meterNameListForSelectedCompany[$i],$meterNameListForSelectedCompany[$i])!!}</td>
                            <td>{!! Form::text($meterIdListForSelectedCompany[$i],null,array('placeholder' => 'Enter Column No. associated with CSV', 'class' => 'form-control'))!!}</td>
                            <td>
                                <select id="parametersListID" class="dropdown-menu" name="parametersList-{{$meterIdListForSelectedCompany[$i]}}">
                                    @for($j=0;$j<sizeof($parameterIdList);$j++)
                                        <option value="{{$parameterIdList[$j]}}">{{$parameterNameList[$j]}}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                    @endfor
                </table>
                {!! Form::hidden('companyNameOnSelectionPage',$selectedCompany)!!}
                {!! Form::submit('Next', array('class'=>'btn btn-primary')) !!}
                {!!Form::close()!!}
            </div><!-- ./col -->
        </div><!-- /.row -->
    </div><!-- /.box-body -->
</div><!-- /.box -->