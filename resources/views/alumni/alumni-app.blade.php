
 <!doctype html>
<html lang="en">
    <head>
        @include('alumni.layouts.head')
    </head>

 <body class="hold-transition skin-blue layout-top-nav">
    <!-- WRAPPER -->
    <div id="wrapper">
        @include('alumni.layouts.alumniheader')
        @yield('content')
    </div>
    
	  @include('alumni.layouts.foot')

	  @include('alumni.events.EventDetailsModal')

</body>
</html>
