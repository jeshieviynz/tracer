<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Events;
use Validator;
use DB;
use Auth;
use Carbon\Carbon;



class EventController extends Controller
{
    





    public function createEvent(Request $request)
	{

	  $restricteddate = Carbon::now()->addWeeks(2)->format('m/d/y');

      $validator = Validator::make($request->all(), [

            'title' => 'required|string|max:100',
            'description' => 'nullable',
            'start' => 'required|date|before:end|after:'.$restricteddate,
            'end' => 'required|date|after:start',
            'eventBatch' => 'required|array|min:1',
            'venue' => 'required|string|max:150',

      ]);




      if ( $validator->passes() ) {

      	  $eventBatchToString = "";

      	  if( count( $request->eventBatch ) != 1 ){
	      	  for( $i = 0; $i <= count( $request->eventBatch )-1 ; $i++){

	      	  	 $eventBatchToString =  $eventBatchToString . $request->eventBatch[$i];

	      	  	 if( count( $request->eventBatch )-1 != $i ){

	      	  	 	$eventBatchToString =  $eventBatchToString . "," ;
	      	  	 }

	      	  }
      	  }else{
      	  	$eventBatchToString = $request->eventBatch[0];
      	  }

          $event = new Events();
          $event->title = $request->title;
          $event->description = $request->description;
          $event->start = Carbon::createFromFormat('m/d/Y H:i A', $request->start );
          $event->end =Carbon::createFromFormat('m/d/Y H:i A', $request->end );
          $event->date = Carbon::parse($request->start)->format('m/d/y').' - '.Carbon::parse($request->end)->format('m/d/y');
          $event->time = Carbon::parse($request->start)->format('g:i A').' - '.Carbon::parse($request->end)->format('g:i A');

          $event->venue = $request->venue;
          $event->eventBatch = $eventBatchToString;
          $event->save();



          $events = Events::all();
          $success = "Successfully added new Event.";
          $content = view('admin.partials.calendar')->with(compact('events'))->render();
          $eventList = view('admin.alumnipage.partials.event-list')->with(compact('events'))->render();


          return response()->json(['content'=> $content, 'EventList' => $eventList, 'success' => $success ]);

   

      }else{

	        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);


		 }




	}

        

    public function updateEvent(Request $request)
	{

	  $restricteddate = Carbon::now()->format('m/d/y');

      $validator = Validator::make($request->all(), [

            'title' => 'required|string|max:100',
            'description' => 'nullable',
            'start' => 'required|date|before:end|after:'.$restricteddate,
            'end' => 'required|date|after:start',
            'eventBatch' => 'required|array|min:1',
            'venue' => 'required|string|max:150',

      ]);







      if ( $validator->passes() ) {

      	  $eventBatchToString = "";

      	  if( count( $request->eventBatch ) != 1 ){
	      	  for( $i = 0; $i <= count( $request->eventBatch )-1 ; $i++){

	      	  	 $eventBatchToString =  $eventBatchToString . $request->eventBatch[$i];

	      	  	 if( count( $request->eventBatch )-1 != $i ){

	      	  	 	$eventBatchToString =  $eventBatchToString . "," ;
	      	  	 }

	      	  }
      	  }else{
      	  	$eventBatchToString = $request->eventBatch[0];
      	  }

          $event = Events::where( 'id' , request()->id )->first();
    
          $event->title = $request->title;
          $event->description = $request->description;
          $event->start = Carbon::createFromFormat('m/d/Y H:i A', $request->start );
          $event->end =Carbon::createFromFormat('m/d/Y H:i A', $request->end );
          $event->date = Carbon::parse($request->start)->format('m/d/y').' - '.Carbon::parse($request->end)->format('m/d/y');
          $event->time = Carbon::parse($request->start)->format('g:i A').' - '.Carbon::parse($request->end)->format('g:i A');

          $event->venue = $request->venue;
          $event->eventBatch = $eventBatchToString;
          $event->update();



          $events = Events::all();
          $success = "Successfully updated Event.";
          $content = view('admin.partials.calendar')->with(compact('events'))->render();
          $eventList = view('admin.alumnipage.partials.event-list')->with(compact('events'))->render();


          return response()->json(['content'=> $content, 'EventList' => $eventList, 'success' => $success ]);

   

      }else{

	        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);


		 }




	}

       






	public function deleteEvent()
	{

		$event = Events::where( 'id' , request()->id )->first();
		$event->status = "cancelled";
		$event->backgroundColor = "#f6161d";
		$event->update();

		$events = Events::all();
		$success = "Event Successfully Deleted.";
    $content = view('admin.partials.calendar')->with(compact('events'))->render();
    $eventList = view('admin.alumnipage.partials.event-list')->with(compact('events'))->render();


		return response()->json(['content'=> $content, 'EventList' => $eventList, 'success' => $success ]);

	} 


	public function resetEvent()
	{

		$event = Events::where( 'id' , request()->id )->first();
		$event->status = "upcoming";
		$event->backgroundColor = "#0fa5bb";
		$event->update();

		$events = Events::all();
		$success = "Event Successfully resetted.";
		$content = view('admin.partials.calendar')->with(compact('events'))->render();
		$eventList = view('admin.alumnipage.partials.event-list')->with(compact('events'))->render();


    return response()->json(['content'=> $content, 'EventList' => $eventList, 'success' => $success ]);
	} 




	public function getEvents(Request $request)
	{
		//return response()->json([ 'events'=> Events::where('status', '!=', 'cancelled')->get() ]);
		$this->EventsStatusManager( Events::all() );
		return response()->json([ 'events'=> Events::all() ]);
	}



        public function getEvent(Request $request)
        {
           $event = Events::where( 'id' , $request->id )->first();

           return response()->json( $event);
        }




    public function EventsStatusManager( $events ){


      foreach ($events as $event) {
        $this->setEventStatus( $event );
      }
      

    }


    public function  setEventStatus( $event ){

      $start = new Carbon($event->start);
      $end = new Carbon($event->end);

      if( $event->status != "cancelled"){

	      if( $start->gt( Carbon::now() ) && $end->gt( Carbon::now() ) ){

	        $event->status = "upcoming";
	        $event->update();

	      }else if( $start->lt( Carbon::now() ) && $end->lt( Carbon::now() ) ){

	        $event->status = "finished";
	        $event->backgroundColor = "#d46c6c";
	        $event->update();

	      }else{

	        $event->status = "ongoing";
	        $event->backgroundColor = "#0c6c32";
	        $event->update();
	      }

  	}


    }

     public function alumniActivities()
        {
            $events = Events::all();


            $years = DB::table('alumni')
            ->select( "Year_Graduated" )
            ->distinct( "Year_Graduated" )
            ->orderBy( 'Year_Graduated', 'DESC')
            ->get();
            $years = collect($years);
            $years = $years->pluck('Year_Graduated');

            return view('admin.alumnipage.alumniActivities',compact( 'events', 'years' ));
        } 



        public function events()
        {

        $events = Events::all();

            $years = DB::table('alumni')
            ->select( "Year_Graduated" )
            ->distinct( "Year_Graduated" )
            ->orderBy( 'Year_Graduated', 'DESC')
            ->get();
            $years = collect($years);
            $years = $years->pluck('Year_Graduated');


          return view('admin.events', compact('events','years'));
        }




}
