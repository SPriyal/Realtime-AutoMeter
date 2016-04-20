@extends('adminPanel.adminDashboard')

@section('content')

    {!! Form::open(array('url'=>'metermapping/Selection/Submit','method'=>'POST', 'files'=>true)) !!}
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">CSV Mapping for {{$selectedCompany}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-condensed">
                        <tbody>
                        <tr>
                            <th>Entity</th>
                            <th>Column Number in CSV</th>
                            <th>Unit</th>
                        </tr>
                        @for($i=0;$i<sizeof($meterIdListForSelectedCompany);$i++)
                        <tr>
                            <td>{!! Form::label($meterNameListForSelectedCompany[$i],$meterNameListForSelectedCompany[$i])!!}
                            </td>
                            <td>{!! Form::text($meterIdListForSelectedCompany[$i],null,array('placeholder' => 'Corresponding Column number', 'class' => 'form-control'))!!}
                            </td>
                            <td>
                                <select id="parametersListID" class="form-control"
                                        name="parametersList-{{$meterIdListForSelectedCompany[$i]}}">
                                    @for($j=0;$j<sizeof($parameterIdList);$j++)
                                        <option value="{{$parameterIdList[$j]}}">{{$parameterNameList[$j]}}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    {!! Form::hidden('companyNameOnSelectionPage',$selectedCompany)!!}
    {!! Form::submit('Add to database', array('class'=>'btn btn-primary btn-lg')) !!}
    {!!Form::close()!!}

@endsection