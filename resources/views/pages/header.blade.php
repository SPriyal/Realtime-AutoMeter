<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>S</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Auto</b>SOFT</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- Sample Link -->
        <li> <a href="#" ><i class="fa fa-file-text"></i><span class="hidden-xs"> Link</span> </a> </li>
        <!-- Reports Menu -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text"></i><span class="hidden-xs"> Reports</span> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/pdf">Today</a></li>
            <li><a href="#">Yesterday </a></li>
            <li class="divider"></li>
            <li><a href="#">Custom date</a></li>
          </ul>
        </li>
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">

          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image" />
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">Account</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
              <p>
                {{Auth::user()->name}} - Web Developer
                <small>Member since Nov. 2012</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Log out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li> <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> </li>

      </ul>
    </div>
  </nav>

</header>