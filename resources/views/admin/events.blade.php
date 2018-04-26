@extends('admin.layouts.app')

@section('content')


 <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <section class="content">

    	<div class="container-header">



        <div class="row">


          @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-check-circle"></i> {{ session()->get('message') }}
          </div>
          @endif
          
        </div>


    		<div id='wrap'>

  				<div id='calendar'>
  				</div>

		  	</div>

   		</div>


    </section>


   </div>
  <!-- /.content-wrapper -->





 
    
     @include('admin.footer.footer')



    @include('alumni.modals.updateEvent')
    @include('alumni.modals.createevent')
      

@endsection