
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>TR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Alumni</b>Tracer</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">


          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">


            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{Auth::user()->avatar}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }} | {{ Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->lastname }}, {{ Auth::user()->firstname }} {{ Auth::user()->middlename }}
                  <small>{{ Auth::user()->username }}</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">

                        <a href="{{ route('logout') }}" class="fa fa-sign-out btn btn-default btn-flat"" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
