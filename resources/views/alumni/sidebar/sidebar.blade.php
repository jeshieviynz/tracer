  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/img/avatars/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
          <p>{{ Auth::user()->username }}</p>
        </div>
      </div>




      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">&nbsp;</li>
        <li class="active"><a href="/events"><i class="fa fa-book"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="/users"><i class="fa fa-book"></i> <span>Users</span></a></li>
        <li><a href="/events"><i class="fa fa-book"></i> <span>Events</span></a></li>
        <li><a href="/reports"><i class="fa fa-book"></i> <span>Reports</span></a></li>
         <li><a href="/Alumni"><i class="fa fa-book"></i> <span>ALumni</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->


  </aside>


