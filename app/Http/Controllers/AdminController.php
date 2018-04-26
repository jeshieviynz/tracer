<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\User;
use App\Events;
use Validator;
use DB;
use App\alumni;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\UpdateUserForm;
use Storage;
use App\Position;
use App\AlumniPosition;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users',compact( 'users' ));
    }
      public function register()
    {
        return view('auth.register');
    }

    //avatar
    public function profile()
    {
        return view('admin.profile', array('user'=>Auth::user()));
    }


    public function update_avatar(Request $request){
      //Handle the user upload of avatar
      if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save( public_path('/img/avatars/' . $filename ));

        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
      }
       return view('admin.profile', array('user'=>Auth::user()));
    }


     public function deleteUser()
    {
        $user = User::where( 'id' , request()->id )->first();
        $user->status=0;
        $user->update();

        $users = User::all();
        return redirect('/users')->with("message","$user->firstname $user->lastname is now Disabled");
    }


    public function getuser( Request $request)
    {
         if($request->ajax()){

            $user = User::where( 'id' , $request->id )->first();

             return response()->json($user);
         }
    }



 public function getalumni( Request $request)
    {
         if($request->ajax()){

            $user = alumni::where( 'id' , $request->id )->first();

             return response()->json($user);
         }
    }

    public function activeUserModal()
    {
            $user = User::where( 'id' , request()->id )->first();
            $user->status=1;
            $user->update();

            $users = User::all();
            return redirect('/users')->with("message","$user->firstname $user->lastname is now Active");

    }









        protected function UpdateUser( Request $request)
        {
          
          $id = $request->id;

          $validator = Validator::make($request->all(),[

            
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'username' => 'required|string|max:10|min:10|unique:users,username,' . $id,
            'email' => 'required|email|string|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',

        ]);
        


        if ($validator->passes()) 
        {

             $user = User::where('id', $id)->first();

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->middlename = $request->middlename;
            $user->username = $request->username;
            $user->email = $request->email;
            if( !empty( $request->password ) ){
              $user->password = bcrypt($request->password);
            }
            $user->role_id = $request->userrole;
            $user->status = 1;
            $user->update();





        if( !empty( $request->file('avatar') ) ){

            $path = $this->uploadAvatar($user->id, $request->file('avatar'));

            $user->avatar =  $path;
            $user->update();

        }

        $user->update();

        $users = User::all();

        return back()->with('message', 'SUCCESSFULY UPDATED USER.')->with(compact( 'users' ));

        }
        else
        {
            $users = User::all();
            return back()->with(compact( 'users' ))->withErrors( $validator->messages())->withInput();
        }



        } 



        protected function UpdateUserProfile( Request $request)
        {
          
          $id = $request->id;

          $validator = Validator::make($request->all(),[

            
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'username' => 'required|string|max:10|min:10|unique:users,username,' . $id,
            'email' => 'required|email|string|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',

        ]);
        


        if ($validator->passes()) 
        {

             $user = User::where('id', $id)->first();

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->middlename = $request->middlename;
            $user->username = $request->username;
            $user->email = $request->email;
            if( !empty( $request->password ) ){
              $user->password = bcrypt($request->password);
            }
            $user->update();





        if( !empty( $request->file('avatar') ) ){

            $path = $this->uploadAvatar($user->id, $request->file('avatar'));

            $user->avatar =  $path;
            $user->update();

        }


        return back()->with('message', 'PROFILE SUCCESSFULY UPDATED.')->with(compact( 'users' ));

        }
        else
        {
            return back()->with(compact( 'users' ))->withErrors( $validator->messages())->withInput();
        }



        } 


 public function uploadAvatar($id, $data){


        //generating unique file name;
        $file_name = 'photo_'.time().'.png';
        $file_name_thumb = 'thumb_'.time().'.png';
        
        $destinationPath = '/public/users/'.$id.'/';

        if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );

        $image = Image::make( $data->getRealPath()  )->resize(400, 400);

        Storage::disk('local')->put( $destinationPath . $file_name,  $image->stream());


        return'/storage/users/'.$id.'/' .$file_name;

    }





    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function alumnis()
    {
      //Get the number of every year graduated
        $years = DB::table('alumni')
              ->select(DB::raw('(Year_Graduated) as year'))
              ->distinct(DB::raw('(Year_Graduated)'))
              ->latest()
              ->get();

        $years = collect($years);
        $years = $years->pluck('year');


        $Alumni = alumni::all();

        return view('admin.Alumni',compact( 'Alumni', 'years' ));
    }


    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter_alumni( Request $request )
    {
        
        if( $request->Batch_Year == "ALL"){
           
           $Alumni = alumni::all();
            $content = view('admin.partials.alumnilist')->with(compact('Alumni'))->render();
            return response()->json(['content'=> $content]);


        }

        $Alumni = alumni::where('Year_Graduated', $request->Batch_Year)->get();
        $content = view('admin.partials.alumnilist')->with(compact('Alumni'))->render();


        return response()->json(['content'=> $content]);
    }






        protected function updateAlumni( Request $request )
        {
          

          $id = $request->id;

          $validator = Validator::make($request->all(),[

            
            'firstname' => 'required|string|max:255|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:255|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'nullable|string|max:1|regex:/^[(a-zA-Z\s)]+$/u',
            'username' => 'required|string|max:10|min:10|unique:alumni,Alumni_ID_Number,' . $id,
            'email' => 'required|email|string|max:255|unique:alumni,Email,' . $id,
            'address' => 'required|string|max:255',
            'homephone' => 'required|numeric|min:6',
            'mobilephone' => 'required|numeric|min:11',
            'Birthday' => 'required|date|string|max:255',
            'course' => 'required|string|max:255',
            'year_graduated' => 'required|numeric',

        ]);
        


        if ($validator->passes()) 
        {

            $record = alumni::where( 'id', $request->id )->first();
            $record->Alumni_ID_Number = $request->username;
            $record->First_Name = $request->firstname;
            $record->Last_Name = $request->lastname;
            $record->Middle_Name = $request->middlename;
            $record->Email = $request->email;
            $record->Birthdate = $request->Birthday;
            $record->Year_Graduated = $request->year_graduated;
            $record->Course = $request->course;
            $record->Address = $request->address;
            $record->Home_Phone = $request->homephone;
            $record->Mobile_Phone = $request->mobilephone;
            $record->update();



            $Alumni = alumni::all();
            $success = "ALUMNI SUCCESSFULY UPDATED.";
            $content = view('admin.partials.alumnilist')->with(compact('Alumni'))->render();
            return response()->json(['content'=> $content, 'success'=> $success]);

        }
        else
        {
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }




        }  
        



        protected function addAlumni( Request $request )
        {
          

          $validator = Validator::make($request->all(),[

            
            'firstname' => 'required|string|max:255|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:255|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'nullable|string|max:1|regex:/^[(a-zA-Z\s)]+$/u',
            'username' => 'required|string|max:10|min:10|unique:alumni,Alumni_ID_Number',
            'email' => 'required|email|string|max:255|unique:alumni',
            'address' => 'required|string|max:255',
            'homephone' => 'required|numeric|min:6',
            'mobilephone' => 'required|numeric|min:11',
            'Birthday' => 'required|date|string|max:255',
            'course' => 'required|string|max:255',
            'year_graduated' => 'required|numeric',

        ]);
        


        if ($validator->passes()) 
        {

            $record = new alumni();
            $record->Alumni_ID_Number = $request->username;
            $record->First_Name = $request->firstname;
            $record->Last_Name = $request->lastname;
            $record->Middle_Name = $request->middlename;
            $record->Email = $request->email;
            $record->Birthdate = $request->Birthday;
            $record->Year_Graduated = $request->year_graduated;
            $record->Course = $request->course;
            $record->Address = $request->address;
            $record->Home_Phone = $request->homephone;
            $record->Mobile_Phone = $request->mobilephone;
            $record->save();



            $Alumni = alumni::all();
            $success = "SUCCESSFULY ADDED NEW ALUMNI.";
            $content = view('admin.partials.alumnilist')->with(compact('Alumni'))->render();
            return response()->json(['content'=> $content, 'success'=> $success]);

        }
        else
        {
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }




        }  
        



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function printGraph( Request $request )
    {
        
        return view('admin.graph-print');

    }




        public function graph()
        {



        //Get the number of every year graduated
          $years = DB::table('alumni')
                ->select(DB::raw('(Year_Graduated) as year'))
                ->distinct(DB::raw('(Year_Graduated)'))
                ->latest()
                ->get();

                $years = collect($years);
                $years = $years->pluck('year');



          $graduates = [];
          $traced = [];
          $unemployed = [];
          $employed = [];
          $untraced = [];
          $related = [];
          $unrelated = [];


         foreach($years as $Year_Graduated)
          {

            $temp = DB::table('alumni')
              ->select('Year_Graduated')
              ->where('Year_Graduated', $Year_Graduated)
              ->get();

            array_push($graduates,  count($temp));


            $temp = DB::table('Employability')
              ->select('Employment')
              ->whereYear( 'updated_at', $Year_Graduated )
              ->where('Employment', 'employed' )
              ->get();



             array_push($employed, count($temp) );


            $temp = DB::table('Employability')
              ->select('Employment')
              ->whereYear( 'updated_at', $Year_Graduated )
              ->where('Employment', 'unemployed' )
              ->get();

             array_push($unemployed, count($temp) );





            $temp = DB::table('alumni')
              ->where( 'Year_Graduated', $Year_Graduated )
              ->where('Account', '1' )
              ->get();


            array_push($traced, count($temp) );


            $temp = DB::table('alumni')
              ->where( 'Year_Graduated', $Year_Graduated )
              ->where('Account', '0' )
              ->get();


           array_push($untraced, count($temp) );

           
           $temp = DB::table('companydetails')
              ->select('Employee_relation')
              ->whereYear( 'updated_at', $Year_Graduated )
              ->where('Employee_relation', 'Related' )
              ->get();


            array_push($related, count($temp) );


            $temp = DB::table('companydetails')
              ->select('Employee_relation')
              ->whereYear( 'updated_at', $Year_Graduated )
              ->where('Employee_relation', 'Unrelated' )
              ->get();


            array_push($unrelated, count($temp) );



          }


        $graduates = [ 'y' => array_sum( $graduates ), 'label' => "Graduates" ];
        $unemployed = [ 'y' => array_sum( $unemployed ), 'label' => "Unemployed" ];
        $employed = [ 'y' => array_sum( $employed ), 'label' => "Employed" ];
        $traced = [ 'y' => array_sum( $traced ), 'label' => "Traced" ];
        $untraced = [ 'y' => array_sum( $untraced ), 'label' => "Untraced" ];
        $related = [ 'y' => array_sum( $related ), 'label' => "Related" ];
        $unrelated = [ 'y' => array_sum( $unrelated ), 'label' => "Unrelated" ];

         return response()->json([  'traced' => $traced , 'untraced' =>  $untraced , 'graduated'=> $graduates , 'employed'=> $employed  , 'unemployed'=>$unemployed , 'related'=> $related, 'unrelated'=> $unrelated ]);
        



        }






        public function graph_filter( Request $request)
        {

        //Get the number of every year graduated
          $years = DB::table('alumni')
                ->select(DB::raw('(Year_Graduated) as year'))
                ->distinct(DB::raw('(Year_Graduated)'))
                ->latest()
                ->get();

                $years = collect($years);
                $years = $years->pluck('year');

          $graduates = [];
          $unemployed = [];
          $employed = [];
          $traced = [];
          $untraced = [];
          $related = [];
          $unrelated = [];

          $Year_Graduated = $request->year;



       
            $temp = DB::table('alumni')
              ->select('Year_Graduated')
              ->where('Year_Graduated', $Year_Graduated)
              ->get();

            array_push($graduates,  count($temp));


            $temp = DB::table('Employability')
              ->select('Employment')
              ->whereYear( 'updated_at', $Year_Graduated )
              ->where('Employment', 'employed' )
              ->get();



             array_push($employed, count($temp) );


            $temp = DB::table('Employability')
              ->select('Employment')
              ->whereYear( 'updated_at', $Year_Graduated )
              ->where('Employment', 'unemployed' )
              ->get();

             array_push($unemployed, count($temp) );





            $temp = DB::table('alumni')
              ->where( 'Year_Graduated', $Year_Graduated )
              ->where('Account', '1' )
              ->get();


            array_push($traced, count($temp) );


            $temp = DB::table('alumni')
              ->where( 'Year_Graduated', $Year_Graduated )
              ->where('Account', '0' )
              ->get();


           array_push($untraced, count($temp) );

           
           $temp = DB::table('companydetails')
              ->select('Employee_relation')
              ->whereYear( 'updated_at', $Year_Graduated )
              ->where('Employee_relation', 'Related' )
              ->get();


            array_push($related, count($temp) );


            $temp = DB::table('companydetails')
              ->select('Employee_relation')
              ->whereYear( 'updated_at', $Year_Graduated )
              ->where('Employee_relation', 'Unrelated' )
              ->get();


            array_push($unrelated, count($temp) );



        $graduates = [ 'y' => array_sum( $graduates ), 'label' => "Graduates" ];
        $unemployed = [ 'y' => array_sum( $unemployed ), 'label' => "Unemployed" ];
        $employed = [ 'y' => array_sum( $employed ), 'label' => "Employed" ];
        $traced = [ 'y' => array_sum( $traced ), 'label' => "Traced" ];
        $untraced = [ 'y' => array_sum( $untraced ), 'label' => "Untraced" ];
        $related = [ 'y' => array_sum( $related ), 'label' => "Related" ];
        $unrelated = [ 'y' => array_sum( $unrelated ), 'label' => "Unrelated" ];



         return response()->json([  'traced' => $traced , 'untraced' =>  $untraced , 'graduated'=> $graduates , 'employed'=> $employed  , 'unemployed'=>$unemployed , 'related'=> $related, 'unrelated'=> $unrelated ]);
        



        }







         public function reports()
        {
          return view('admin.graph');
        }

         public function googlemap()
        {
          return view('admin.maps');
        }



         public function createEvent(Request $request)
        {

           $validator = Validator::make($request->all(),[

                  'title' => 'required|string|min:2',
                  'venue' => 'required|string|min:2',
                  'time' => 'required|string|min:2',
                  'date' => 'required|string|min:2',
                  'description' => 'required|string|min:2',
                  'eventBatch' => 'required|string|min:2',
                ]);

                if ($validator->passes()) 
                {
                  
                $event = new Events();

                $event->title = $request->title; 
                $event->venue = $request->venue;
                $event->time = new Carbon($request->time);
                $event->date = new Carbon($request->date);
                $event->description = $request->description;
                $event->eventBatch = $request->eventBatch;  
                $event->save();

                $events = Events::select('id','title','venue', 'time', 'date','description','eventBatch')->get();

                return response()->json(['success'=> 'EVENT SUCCESSFULY CREATED!', 'events'=>$events]);


                }
                else
                {
                  return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
                }

        }

        



        public function getEvent(Request $request)
        {
           $event = Events::where( 'id' , request()->id )->first();

           return response()->json( $event);
        }

        public function updateEvent(Request $request)
        {
           $validator = Validator::make($request->all(),[

                  'title' => 'required|string|min:2',
                  'venue' => 'required|string|min:2',
                  'time' => 'required|string|min:2',
                  'date' => 'required|string|min:2',
                  'description' => 'required|string|min:2',
                  'eventBatch' => 'required|string|min:2',
                ]);

                if ($validator->passes()) 
                {
                
                $event = Events::where( 'id' , request()->id )->first();
    
                $event->title = $request->title; 
                $event->venue = $request->venue;
                $event->time = new Carbon($request->time);
                $event->date = new Carbon($request->date);
                $event->description = $request->description;
                $event->eventBatch = $request->eventBatch;  
                $event->update();

                 $events = Events::select('id','title','venue', 'time', 'date','description','eventBatch')->get();

                 return response()->json(['success'=>'Event has been updated!', 'events'=>$events]);

                }
                else
                {
                  return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
                } 
          
        }



        public function deleteEvent()
        {

            $event = Events::where( 'id' , request()->id )->first();
            $event->delete();

             $events = Events::select('id','title','venue', 'time', 'date','description','eventBatch')->get();

            return response()->json(['success'=>'Event has been deleted!', 'events'=>$events]);
        } 



        public function staff()
        {
            return view('admin.staff');
        }


         public function adminpage()
        {
            return view('admin.pages.admin');
        }


        public function alumniOfficers()
        {
          $positions = DB::table('positions')
                ->select('alumni.id as alumni_id','alumni.First_Name','alumni.Last_Name','alumni.Middle_Name', 'positions.position', 'alumni.Email', 'positions.id as position_id')
                ->leftjoin('alumniofficers', 'alumniofficers.position_id', '=', 'positions.id')
                ->leftjoin('alumni', 'alumni.id', '=', 'alumniofficers.alumni_id')
                ->get();


          return view('admin.alumnipage.alumniOfficers', compact('positions'));

        }

        public function alumniActivities()
        {
            return view('admin.alumnipage.alumniActivities');
        }
        public function notablealumni()
        {


          $Alumni = DB::table('alumni')
            ->join('users', 'users.alumni_id', '=', 'alumni.id')
            ->join('companydetails', 'companydetails.alumni_id', '=', 'alumni.id')
            ->where('companydetails.job_title','Accounting Manager')
            //->orWhere('companydetails.job_title','JOBTITLE')
            ->get();

          return view('admin.notable-alumni', compact( 'Alumni' ));



        }





    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function AllTracedAlumni()
    {
        $ids = DB::table('alumniofficers')
                ->pluck('alumni_id');

        $Alumni = DB::table('alumni')
                ->select('alumni.id as alumni_id','alumni.First_Name','alumni.Last_Name', 'alumni.Alumni_ID_Number', 'alumni.Course', 'alumni.Email')
                ->WhereNotIn('id', $ids)
                ->where('alumni.Account','1')
                ->get();

        $content = view('admin.alumnipage.partials.alumniList')->with(compact('Alumni'))->render();
        return response()->json(['content'=> $content]);
    }


   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ElectOfficer( Request $request )
    {


     $validator = Validator::make($request->all(),[

      'position_id' => 'required',
      'alumni_id' => 'required',
    ]);

    if ($validator->passes()) 
    {
               
         $alumniofficer = AlumniPosition::where('position_id', $request->position_id )->first();

         if( empty( $alumniofficer) ){

              $alumniofficer = new AlumniPosition();
              $alumniofficer->alumni_id = $request->alumni_id;
              $alumniofficer->position_id = $request->position_id;
              $alumniofficer->save();


             $positions = DB::table('positions')
                  ->select('alumni.id as alumni_id','alumni.First_Name','alumni.Last_Name','alumni.Middle_Name', 'positions.position', 'alumni.Email', 'positions.id as position_id')
                  ->leftjoin('alumniofficers', 'alumniofficers.position_id', '=', 'positions.id')
                  ->leftjoin('alumni', 'alumni.id', '=', 'alumniofficers.alumni_id')
                  ->get();


              $content = view('admin.alumnipage.partials.officer-positions')->with(compact('positions'))->render();
              return response()->json(['content'=> $content, 'success'=>'New officer has been elected.']);

         }else{

            $alumniofficer->alumni_id = $request->alumni_id;
            $alumniofficer->position_id = $request->position_id;
            $alumniofficer->update();


            $positions = DB::table('positions')
                  ->select('alumni.id as alumni_id','alumni.First_Name','alumni.Last_Name','alumni.Middle_Name', 'positions.position', 'alumni.Email', 'positions.id as position_id')
                  ->leftjoin('alumniofficers', 'alumniofficers.position_id', '=', 'positions.id')
                  ->leftjoin('alumni', 'alumni.id', '=', 'alumniofficers.alumni_id')
                  ->get();

            $content = view('admin.alumnipage.partials.officer-positions')->with(compact('positions'))->render();
            return response()->json(['content'=> $content, 'success'=>'Officer position has been updated.']);

         }


      }else
          {
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
          } 




    }






























}
