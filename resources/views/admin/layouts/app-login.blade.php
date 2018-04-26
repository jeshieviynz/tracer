 <!doctype html>
<html lang="en">
    <head>
        @include('admin.layouts.head')

    </head>

 <body class="alumni-login-body">
    <!-- WRAPPER -->
    <div id="wrapper alumni-login">
    	
        @yield('content')
        
    </div>

@include('alumni.modals.error')
@include('admin.layouts.modals.user-acount')
@include('admin.layouts.modals.success')

    <!-- END WRAPPER -->
@include('admin.layouts.foot')
</body>
</html>
