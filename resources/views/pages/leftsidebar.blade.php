<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  {{--style can be found in sidebar.less--}}
  <section class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel">
      {{--<div class="pull-left image">--}}
        {{--<img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />--}}
      {{--</div>--}}
      {{--<div class="pull-left info">--}}
        {{--<p>TEXT 1</p>--}}
        <!-- Status -->
        <a href="#"><i class="fa fa-building fa-2x text-blue"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; XYZ Solutions pvt ltd</a>
      {{--</div>--}}
    </div>

    <!-- search form -->

    <form action="#" method="get" class="sidebar-form">
      <div class="input-group" >
        <div id="searchCompany">
            <input type="text" name="q"  class="form-control" placeholder="Search..."/>
        </div>
        <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
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
