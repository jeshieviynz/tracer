  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section>
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
          <p>{{ Auth::user()->username }}</p>
        </div>
      </div>




      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">&nbsp;</li>
        <li class="active"><a href="/dashboard"><i class="fa fa-book"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="/users"><i class="fa fa-user"></i> <span>Users</span></a></li>

        <li><a href="/reports"><i class="fa fa-file-text"></i> <span>Reports</span></a></li>
        <li class="treeview">
            <a href="#"><i class="fa fa-graduation-cap"></i> <span>Alumni</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/Alumni"><i class="fa fa-circle-o"></i> Graduates</a></li>
              <li><a href="/Alumniofficer"><i class="fa fa-circle-o"></i> Officers</a></li>
              <li><a href="/Alumniactivities"><i class="fa fa-circle-o"></i> Activities</a></li>
              <li><a href="/events"><i class="fa fa-calendar-minus-o"></i> Activities Calendar</a></li>
            </ul>
          
       </li>


      </ul>
    </section>
    <!-- /.sidebar -->


  </aside>


