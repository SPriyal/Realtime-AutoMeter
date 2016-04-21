<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  {{--style can be found in sidebar.less--}}
  <section class="sidebar">

    <ul class="sidebar-menu">
      <li class="active">
        <a href="/addcompany">
          <i class="fa fa-share"></i> <span>Add Company</span>
        </a>
      </li>

      <li>
        <a href="/metermapping">
          <i class="fa fa-files-o"></i> <span>Meter Mapping</span>
        </a>
      </li>

      <li>
        <a href="/adduser">
          <i class="fa fa-user"></i> <span>Add User</span>
        </a>
      </li>

      <li class="treeview active">
        <a href="#">
          <i class="fa fa-table"></i> <span>Database</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          {{--show all companies with their respective ID--}}
          <li><a href="companylist"><i class="fa fa-circle-o"></i> Company List</a></li>
          <li><a href="Allentitylist"><i class="fa fa-circle-o"></i> Companies Table</a></li>
          <li><a href="parameterlist"><i class="fa fa-circle-o"></i> Parameters</a></li>
          <li><a href="userlist"><i class="fa fa-circle-o"></i> Users</a></li>
          <li><a href="datalist"><i class="fa fa-circle-o"></i> Data</a></li>
        </ul>
      </li>


      <li>
        <a href="#">
          <i class="fa fa-pie-chart"></i> <span>Analytics</span>
        </a>
      </li>

      <li>
        <a href="#">
          <i class="fa fa-user"></i> <span>Notifications/Errors/Logs</span>
        </a>
      </li>


    {{--  <li>
        <a href="#">
          <i class="fa fa-calendar"></i> <span>Calendar</span>
        </a>
      </li>

      <li>
        <a href="#">
          <i class="fa fa-envelope"></i> <span>Mailbox</span>
          <small class="label pull-right bg-yellow">12</small>
        </a>
      </li>

      <li>
        <a href="#">
          <i class="fa fa-folder"></i> <span>File manager</span>
        </a>
      </li>

      <li>
        <a href="#">
          <i class="fa fa-user"></i> <span>Profile</span>
        </a>
      </li>--}}

      
      <li><a href="#"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
      <li class="header">LABELS</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    </ul>

  </section>
  <!-- /.Left sidebar -->
</aside>
