<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "AutoSoft Dashboard" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link href="{{ asset("/css/autosoft.css") }}" rel="stylesheet" type="text/css" />
      <!-- pace : Automatic page load progress bar -->
      <script src="{{ asset ("/bower_components/admin-lte/plugins/pace/pace.js") }}"></script>
    <script src="{{ asset ("/bower_components/admin-lte/plugins/fastclick/fastclick.js") }}"></script>
    <link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Apply the skin class to the body tag so the changes take effect. -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css") }}"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
      <script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    		{{--<style type="text/css">${demo.css}</style>--}}
      @yield('contentLiveGraphHead')


  </head>

  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      {{--<!-- Header -->--}}
      @include('pages.header')

      {{--<!-- Left Sidebar -->--}}
      @include('pages.leftsidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->

        <section class="content">
          <!-- Page Content -->
          @yield('contentFourBox')
          @yield('contentLiveGraph')
          @yield('contentDataTable')
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('pages.footer')

      <!--Right Control Sidebar and settings menu -->
      @include('pages.RightControlSidebar')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <script src="{{ asset ("/bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("/bower_components/admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>

    <!-- Optionally, add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the 
          user experience -->
          <script>
              $.ajaxSetup({headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }});
          </script>
          {{--Following are the Scripts necessary for graph--}}
          <script src="{{ asset ("/js/highstock.js") }}"></script>
          <script src="{{ asset ("/js/exporting.js") }}"></script>

              <!-- DataTables -->
              <script src="{{ asset ("/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js") }}"></script>
              <script src="{{ asset ("/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
                    <script>
                        $(function () {
                            $("#example1").DataTable();
                            $('#example2').DataTable({
                                "paging": true,
                                "lengthChange": false,
                                "searching": false,
                                "ordering": true,
                                "info": true,
                                "autoWidth": false
                            });
                        });
                    </script>
              <!-- SlimScroll -->
              <script src="{{ asset ("/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
              <!-- AdminLTE for demo purposes -->
              <script src="{{ asset ("/bower_components/admin-lte/dist/js/demo.js") }}"></script>
              <!-- page script -->

  </body>
</html>