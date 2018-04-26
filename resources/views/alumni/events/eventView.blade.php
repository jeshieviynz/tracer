@extends('alumni.alumni-app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

    	<div class="nav-tabs-custom">

          
            <div class="tab-content">

			      <div class="row">
			        <div class="col-md-5">
			        	<div class="col-md-12">EVENTS</div>
			        	<br/>
			        	<div class="eventList-con">
			        	<ul class="nav nav-pills nav-stacked">

			        		@if( count( $events ) > 0 )
				        		@php ($count = 1)

				        		@foreach( $events as $event )

				                <li><a id="{{$event->id}}" class=" @if($count == 1) selected @endif eventList-item">

				                  <span class="pull-right label label-success event-status-alumni">{{ $event->status }}</span>
				                  {{ $event->title }}<br/>

				                  <span class="">{{ $event->date }}</span>
				                  <span class="">&nbsp; {{ $event->time }} &nbsp;</span>
				                    
				              		</a>
				              	</li>
				              	@php ($count++)
				                @endforeach
				            @else
				            	<p>No Event.</p>
			                @endif

			              </ul>
			              </div>
			        </div>

			        <div class="col-md-7">

			        	@if( count( $events ) > 0)
			        	<div class="eventList-con-desc">

			        		<h2>TITLE : <span  class="view-event-title">{{ @$events[0]->title }}</span></h2>
			        		<p>Batch : <span class="view-event-batch">{{ @$events[0]->eventBatch }}</span></p> 
			        		<p>DATE & TIME : <span class="view-event-date">{{ @$events[0]->date }} {{ @$events[0]->time }}</span></p> 
			        		<p>VENUE : <span class="view-event-venue">{{ @$events[0]->venue }}</span></p>
			        		<p>DESCTIPTION :</p>
			        		<div class="view-event-desc">{!! @$events[0]->description !!}</div>


			        	</div>

			        	@endif


			        </div>

			      </div>


             
            </div>
            <!-- /.tab-content -->
        </div>

	</section>

</div>


@include('admin.footer.footer')

 @endsection