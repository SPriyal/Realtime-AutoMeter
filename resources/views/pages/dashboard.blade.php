<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "AutoSoft Dashboard" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- pace : Automatic page load progress bar -->
    <link href="{{ asset("/css/autosoft.css") }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset ("/bower_components/admin-lte/plugins/pace/pace.js") }}"></script>
    <script src="{{ asset ("/bower_components/admin-lte/plugins/fastclick/fastclick.js") }}"></script>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
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
    		{{--<style type="text/css">--}}
    {{--${demo.css}--}}
    		{{--</style>--}}
    		<script type="text/javascript">
                $(function () {
                    var datePreviouslyTaken,dateCheck=0,dateCurrentOne;
                    var feedback = <?php echo json_encode($dataForPreviousValues); ?>;
                    {{----}}
//                    document.writeln(feedback);
                    var feedbackLength = feedback.length;
                    datePreviouslyTaken = Date.createFromMysql(feedback[feedbackLength - 1].dateTime);
                    var parameterName = "kWH";
                    //Following will check if URL parameter exits or not.
                    var field = 'pname';
                    var url = window.location.href;
                    if(url.indexOf('?' + field + "=power") != -1 || url.indexOf('&' + field + "=power") != -1) {
                        parameterName = "kWH";
                    }
                    else if(url.indexOf('?' + field + "=electricity") != -1 || url.indexOf('&' + field + "=electricity") != -1) {
                        parameterName = "ampere";
                    }
                    else if(url.indexOf('?' + field + "=production") != -1 || url.indexOf('&' + field + "=production") != -1) {
                        parameterName = "degreeC";
                    }
                    else if(url.indexOf('?' + field + "=water") != -1 || url.indexOf('&' + field + "=water") != -1) {
                        parameterName = "bar";
                    }
                    else
                        parameterName = "kWH";
                    //document.writeln(feedback[1].kWH);
                    Highcharts.setOptions({
                        global : {
                            useUTC : false
                        }
                    });
                    // Create the chart
                    $('#chartContainer').highcharts('StockChart', {
                        chart : {
                            events : {
                                load : function () {
                                    // set up the updating of the chart each second
                                    var series = this.series[0];
                                    setInterval(function () {
                                        var feedbackLive ;
                                        feedbackLive = $.ajax({
                                            type: "POST",
                                            cache: false,
                                            url: "/liveGraphValues",
                                            async: false
                                        }).success(function(){
                                            setTimeout(function(){get_fb_success();}, 500);
                                        }).responseText;
                                        //document.write("<br>feedback is " + feedbackLive  );
                                        function get_fb_success() {
                                            if(feedbackLive != "[]")
                                            {
                                                feedbackLive = JSON.parse(feedbackLive);
                                                var graphJSONincrementer = 0;
                                                //Folowing is to initialize HTML elements with particular ids, so as to prevent error!
                                                window.onload = settingElements();
                                                function settingElements() {
                                                    document.getElementById("kwh").innerHTML = parseInt(feedbackLive[graphJSONincrementer].kWH);
                                                    document.getElementById("ampere").innerHTML = parseInt(feedbackLive[graphJSONincrementer].ampere);
                                                    document.getElementById("degreeC").innerHTML = parseInt(feedbackLive[graphJSONincrementer].degreeC);
                                                    document.getElementById("bar").innerHTML = parseInt(feedbackLive[graphJSONincrementer].bar);
                                                    document.getElementById("kwhMoney").innerHTML = (parseInt(feedbackLive[graphJSONincrementer].kWH)*6.986).toFixed(2);
                                                }
                                                //Following will check, if value is missed or not with the help of date... If missed then the page will be reloaded.
                                                dateCurrentOne = Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime);
                                                var subDate = dateCurrentOne - datePreviouslyTaken;
                                                if(subDate <15500)  {
                                                    if(parameterName == "kWH") {
                                                        var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime)), // current time
                                                            y = feedbackLive[graphJSONincrementer].kWH;
                                                    } else if(parameterName == "ampere") {
                                                        var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime)), // current time
                                                            y = feedbackLive[graphJSONincrementer].ampere;
                                                    } else if(parameterName == "degreeC") {
                                                        var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime)), // current time
                                                            y = feedbackLive[graphJSONincrementer].degreeC;
                                                    } else if(parameterName == "bar") {
                                                        var x = Number(Date.createFromMysql(feedbackLive[graphJSONincrementer].dateTime)), // current time
                                                            y = feedbackLive[graphJSONincrementer].bar;
                                                    }
                                                    series.addPoint([x, y], true, true);
                                                    graphJSONincrementer++;
                                                    datePreviouslyTaken = dateCurrentOne;
                                                }
                                                else
                                                    location.reload();
                                            }
                                        }}, 4000);
                                }
                            }
                        },

                        rangeSelector: {
                            buttons: [{
                                count: 1,
                                type: 'minute',
                                text: '1M'
                            }, {
                                count: 5,
                                type: 'minute',
                                text: '5M'
                            }, {
                                count: 30,
                                type: 'minute',
                                text: '30M'
                            }, {
                                count: 1,
                                type: 'hour',
                                text: '1H'
                            }, {
                                count: 3,
                                type: 'hour',
                                text: '3H'
                            },{
                                count: 6,
                                type: 'hour',
                                text: '6H'
                            }, {
                                type: 'sll',
                                text: 'ALL'
                            }],
                            inputEnabled: false,
                            selected: 1
                        },

                        title : {
                            text : ''
                        },

                        exporting: {
                            enabled: false
                        },

                        series : [{
                            name : parameterName,
                            data : (function () {
                                // generate graph for previousData
                                    window.onload = settingElements(); //Sets Tile values to the latest recent value
                                    function settingElements() {
                                        document.getElementById("kwh").innerHTML = parseInt(feedback[feedbackLength - 1].kWH);
                                        document.getElementById("ampere").innerHTML = parseInt(feedback[feedbackLength - 1].ampere);
                                        document.getElementById("degreeC").innerHTML = parseInt(feedback[feedbackLength - 1].degreeC);
                                        document.getElementById("bar").innerHTML = parseInt(feedback[feedbackLength - 1].bar);
                                        document.getElementById("kwhMoney").innerHTML = (parseInt(feedback[feedbackLength - 1].kWH)*6.986).toFixed(2);
                                    }

                                    var data = [], i;
                                    //Pushes values/data to graph to display
                                    for (i = -(feedbackLength-1),j=0; i <= 0 ; i += 1,j++) {
                                        if(parameterName == "kWH") {
                                            data.push([
                                                Number(Date.createFromMysql(feedback[j].dateTime)),
                                                parseInt(feedback[j].kWH)
                                            ]);
                                        } else if(parameterName == "ampere") {
                                            data.push([
                                                Number(Date.createFromMysql(feedback[j].dateTime)),
                                                parseInt(feedback[j].ampere)
                                            ]);
                                        } else if(parameterName == "degreeC") {
                                            data.push([
                                                Number(Date.createFromMysql(feedback[j].dateTime)),
                                                parseInt(feedback[j].degreeC)
                                            ]);
                                        } else if(parameterName == "bar") {
                                            data.push([
                                                Number(Date.createFromMysql(feedback[j].dateTime)),
                                                parseInt(feedback[j].bar)
                                            ]);
                                        }
                                    }
                                    return data;
                            }())
                        }]
                    });

                });

                Date.createFromMysql = function(mysql_string)  //Converts SQL DateTime format to Javascript format.
                {
                    if(typeof mysql_string === 'string')
                    {
                        var t = mysql_string.split(/[- :]/);
                        return new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
                    }
                    return null;
                }
            </script>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      {{--<!-- Header -->--}}
      @include('pages.header')

      {{--<!-- Left Sidebar -->--}}
      @include('pages.leftsidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        {{--<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {{ $page_title or null }}
            <small>{{ $page_description or null }}</small>
          </h1>
          <!-- You can dynamically generate breadcrumbs here -->
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Root</a></li>
            <li><a href="#"></i> Level1</a></li>
            <li class="active">Here</li>
          </ol>
        </section>--}}

        <!-- Main content -->

        <section class="content">
          <!-- Page Content -->
          @yield('content')
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('pages.footer')

      <!--Right Control Sidebar and settings menu -->
      @include('pages.RightControlSidebar')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->


    <!-- jQuery 2.1.4 -->
    <script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("/bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("/bower_components/admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>

    <!-- Optionally, add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the 
          user experience -->
          <script>
              $.ajaxSetup({
                               headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                           });
          </script>
          {{--Following are the Scripts necessary for graph--}}
          <script src="{{ asset ("/js/highstock.js") }}"></script>
          <script src="{{ asset ("/js/exporting.js") }}"></script>


              <!-- DataTables -->
              <script src="{{ asset ("/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js") }}"></script>
              <script src="{{ asset ("/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
              <!-- SlimScroll -->
              <script src="{{ asset ("/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
              <!-- FastClick -->

              <!-- AdminLTE for demo purposes -->
              <script src="{{ asset ("/bower_components/admin-lte/dist/js/demo.js") }}"></script>
              <!-- page script -->

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
  </body>
</html>