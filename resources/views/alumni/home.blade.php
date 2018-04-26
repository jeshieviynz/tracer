@extends('alumni.alumni-app')

@section('content')



<div class="content-wrapper">

    <!-- Main content -->
    <section class="content home-content">

    	<div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="img/background/1.jpeg" alt="Dean's Office">
          </div>

          <div class="item">
            <img src="img/background/2.jpeg" alt="Chicago">
          </div>

          <div class="item">
            <img src="img/background/3.jpeg" alt="Chicago">
          </div>

          <div class="item">
            <img src="img/background/4.jpeg" alt="Chicago">
          </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>




    </section>

</div>

		@include('admin.footer.footer')

 @endsection