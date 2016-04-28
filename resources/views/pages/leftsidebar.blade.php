<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  {{--style can be found in sidebar.less--}}
  <section class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel">
        <a href="#"><i class="fa fa-building fa-2x text-blue"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$companyAndMeterNames[0]['companyName']}}</a>
    </div>


    {{--<div id="remote">--}}
        {{--<input type="text" class="typeahead" placeholder="Search...">--}}
     {{--</div>--}}
    <!-- /.search form -->

    <div id="remote">
        {!! Form::open(array('url'=>'searchResult','method'=>'POST', 'files'=>true)) !!}
        {!! Form::text('searchBox',null,array('placeholder' => 'Search','id'=>'inputSuccess', 'class' => 'form-control typeahead input-lg' )) !!}
        {{--{!! Form::submit('Search', array('class'=>'btn btn-primary')) !!}--}}
        {!!Form::close()!!}
    </div>

    <!-- Sidebar Menu hierarchy-->
    <div><ul class="sidebar-menu"> {!! $html !!} </ul></div>
    <!-- /.sidebar-menu hierarchy-->






  </section>
  <!-- /.Left sidebar -->
</aside>
