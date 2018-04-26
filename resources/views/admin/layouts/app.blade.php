 <!doctype html>
<html lang="en">
    <head>
        @include('admin.layouts.head')
        
        

    </head>

 <body class="hold-transition skin-blue sidebar-mini">
 	
    <!-- WRAPPER -->
    <div id="wrapper">
    	@include('admin.header.header')
    	@include('admin.sidebar.sidebar')
    	
        @yield('content')


    </div>

    
    @include('admin.layouts.foot')


    <!-- END WRAPPER -->

    <!--User modal-->
    @include('admin.layouts.modals.delete')
    @include('admin.layouts.modals.active')
    @include('admin.layouts.modals.update')
    @include('admin.layouts.modals.view-user')
    @include('admin.layouts.modals.view-activities')
    @include('admin.layouts.modals.add-alumni')
    @include('admin.layouts.modals.elect-officer')
    @include('admin.layouts.modals.notableAlumni')

    <!-- modal-->
    @include('alumni.modals.active')
    @include('alumni.modals.delete')
    @include('alumni.modals.update')
    @include('admin.layouts.modals.import') 
    @include('alumni.modals.error')
    @include('admin.layouts.modals.success')
    @include('alumni.modals.yesOrNo')
    @include('alumni.events.eventError')
    @include('alumni.events.resumeEventslist')
    @include('admin.layouts.modals.graduateDetails')

        

</body>
</html>
