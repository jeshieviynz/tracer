
 <!doctype html>
<html lang="en">
    <head>

        @include('admin.layouts.head')
       

    </head>

 <body class="admin-body">
    <!-- WRAPPER -->
    <div id="wrapper">
        @include('admin.header.header')
        @include('admin.sidebar.sidebar')
        @yield('content')
    </div>
    <!-- END WRAPPER -->

            <!--User modal-->
        @include('admin.layouts.modals.delete')
        @include('admin.layouts.modals.active')
        @include('admin.layouts.modals.update')
        @include('admin.layouts.modals.update-profile')
        @include('admin.layouts.modals.import') 

        <!--Alumni modal-->
        @include('alumni.modals.active')
        @include('alumni.modals.delete')
        @include('alumni.modals.update')
        @include('admin.layouts.foot')
        

</body>
</html>
