<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  {{--style can be found in sidebar.less--}}
  <section class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel">
        <a href="home"><i class="fa fa-building fa-2x text-blue"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$companyAndMeterNames[0]['companyName']}}</a>
    </div>


    {{--<div id="remote">--}}
        {{--<input type="text" class="typeahead" placeholder="Search...">--}}
     {{--</div>--}}
    <!-- /.search form -->

    <!-- Sidebar Menu hierarchy-->
    <div><ul class="sidebar-menu"> {!! $html !!} </ul></div>
    <!-- /.sidebar-menu hierarchy-->






  </section>
  <!-- /.Left sidebar -->
</aside>
