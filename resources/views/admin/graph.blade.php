@extends('admin.layouts.app')

@section('content')
 

    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        TRACER
        <small> > Reports</small>
      </h1>
    </section>
      
        <head>
            <script src="js/Chart.bundle.js"></script>
            <script src="js/utils.js"></script>
            <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
            </style>
        </head>

        <body>
            <div style="width: 75%">
                <canvas id="canvas"></canvas>
            </div>


        </body>

        <div>
            
        </div>

</div>

 @include('admin.footer.footer')
    <!-- /.content -->


@endsection
 