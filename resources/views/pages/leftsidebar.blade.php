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

    {{-- TODO -  ============Following code works well with AdminLTE searchBar & TypeAhead, only CSS is a problem... Even suggestions ar visible... Just their is some UI problem.. Please somebody solve it============= --}}
{{--<form data-url="searchResult" method="get" class="sidebar-form">--}}
    {{--<div id="remote" class="input-group" style="overflow: visible">--}}

            {{--<input type="text" name="searchBox" id="inputSuccess" class="form-control typeahead" placeholder="Search..."/>--}}
            {{--<span class="input-group-btn">--}}
                {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
            {{--</span>--}}

        {{--{!! Form::open(array('url'=>'searchResult','method'=>'POST', 'files'=>true)) !!}--}}
        {{--{!! Form::text('searchBox',null,array('placeholder' => 'Search','id'=>'inputSuccess', 'class' => 'form-control typeahead input-lg' )) !!}--}}
        {{--{!! Form::submit('Search', array('class'=>'btn btn-primary')) !!}--}}
        {{--{!!Form::close()!!}--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--============================================AdminLTE Search with working TypeAhead Finish==========================--}}

    <div id="remote" class="user-panel" style="overflow: visible">
        {!! Form::open(array('url'=>'searchResult','method'=>'POST', 'files'=>true)) !!}
        {!! Form::text('searchBox',null,array('placeholder' => 'Search Anything...','id'=>'inputSuccess', 'class' => 'form-control typeahead input-lg' )) !!}
        {{--{!! Form::submit('Search', array('class'=>'btn btn-primary')) !!}--}}
        {!!Form::close()!!}
    </div>

    <!-- Sidebar Menu hierarchy-->
    <div><ul class="sidebar-menu"> {!! $html !!} </ul></div>
    <!-- /.sidebar-menu hierarchy-->






  </section>
  <!-- /.Left sidebar -->
</aside>
