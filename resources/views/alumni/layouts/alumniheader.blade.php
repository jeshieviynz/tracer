
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b>Alumni</b>Tracer</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/home">HOME</a></li>
            <li ><a href="/viewEvent">EVENTS </a></li>
            <li class="active">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">ALUMNI <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/batchmates">Batch Mates</a></li>
                  <li><a href="/Officers">Officers</a></li>
                </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <ul class="nav navbar-nav">


          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">


            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ Auth::user()->avatar }}" class="user-image" alt="User Image">
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
                  <a href="/myprofile" class="btn btn-default btn-flat">Profile</a>
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

          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  