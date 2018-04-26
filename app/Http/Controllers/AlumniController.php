<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alumni;
use App\User;
use App\Events;
use App\Employability;
use App\CompanyDetails;
use App\Repositories\alumniRepositories;
use DB;
use Auth;
use Validator;
use Image;
use Storage;


class AlumniController extends Controller
{




   public function deleteAlumni()
    {
        $alumni = alumni::where( 'id' , request()->id )->first();
        $alumni->status=0;
        $alumni->update();

        $alumni = alumni::all();
        return redirect('/Alumni')->with("message","SUCCESSFULY  ");
    }


        public function toactiveAlumni( Request $request)
        {
            
                $alumni = alumni::where( 'id' , $request->id )->first();
                $alumni->status=1;
                $alumni->update();

                $alumni = alumni::all();
                return redirect('/Alumni')->with("message","SUCCESSFULY  ");

        }






        public function  proceed(Request $request)
        {
            $repositories = new alumniRepositories;
            $alumni = $repositories->getalumniName($request->first_name, $request->last_name, $request->middle_name, $request->bday);

            if (count($alumni)>0) 
            {

                return response()->json(['success'=> 'Account has been verified!','alumni'=>$alumni]);
                 
            }

            else
            {
               return response()->json(['error'=> 'No record found']);
            
            }
        }





            public function createaccount(Request $request)
            {
                $validator = Validator::make($request->all(),[

                  'username' => 'required|string|min:2',
                  'email' => 'required|string|email|min:2|unique:users',
                  'password' => 'required|string|min:2|confirmed',
                  'password_confirmation' => 'required|string|min:2',
                ]);
                
                if ($validator->passes()) 
                {
                  
                $alumni = alumni::where('Alumni_ID_Number', $request->username)->first();
                $alumni->Account=0; 
                $alumni->email=$request->email;
                $alumni->update();

                $user = new User();

                $user->alumni_id = $alumni->id;
                $user->firstname = $alumni->First_Name; 
                $user->lastname = $alumni->Last_Name;
                $user->middlename = $alumni->Middle_Name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role_id = 4;
                $user->status = 1;
                $user->save();

                
                if( !empty( $request->file('avatar') ) ){

                    $path = $this->uploadAvatar($user->id, $request->file('avatar'));

                    $user->avatar =  $path;
                    $user->update();

                }else{

                    $user->avatar = '/storage/users/default.jpg';
                    $user->update();
                }




                return response()->json(['success'=> 'SUCCESSFULY CREATED ALUMNI USER!']);

                }
                else
                {
                  return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
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






        public function PersonalInfoSurvey_Step1(Request $request)
        {

             $validator = Validator::make($request->all(),[

                  'Address' => 'required|string|max:225',
                  'Home_Phone' => 'required|numeric|min:6',
                  'Mobile_Phone' => 'required|numeric|min:11'
                 
                ]);
                
                if ($validator->passes()) 
                {


                    $alumnidetails = Employability::where("alumni_id", $request->alumni_id )->first();


                    if( !empty($alumnidetails) ){

                        $alumnidetails->alumni_id = $request->alumni_id;
                        $alumnidetails->Address = ucfirst(strtolower( $request->Address));
                        $alumnidetails->Home_Phone = ucfirst(strtolower( $request->Home_Phone));
                        $alumnidetails->Mobile_Phone = ucfirst(strtolower( $request->Mobile_Phone));
                        $alumnidetails->update();

                    }else{


                        $Aemployer = new Employability();
                    
                        $Aemployer->alumni_id = $request->alumni_id;
                        $Aemployer->Address = ucfirst(strtolower( $request->Address));
                        $Aemployer->Home_Phone = ucfirst(strtolower( $request->Home_Phone));
                        $Aemployer->Mobile_Phone = ucfirst(strtolower( $request->Mobile_Phone));
                        $Aemployer->Employment = "";

                        $Aemployer->save();

                    }



                    

                    return response()->json(['success'=> "success" ]);

                }else
                {
                    return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
                }



            }




        public function EmploymentInfoSurvey_Step2(Request $request)
        {

                $validator = Validator::make($request->all(),[

                  'job_title' => 'required|string|min:2',
                  'Company_connected' => 'required|string|min:2',
                  'company_phone_number' => 'required|numeric|min:2',
                  'company_address' => 'required|string|min:2'
                 
                ]);
                
                if ($validator->passes()) 
                {


                    $campanyDetails = CompanyDetails::where("alumni_id", $request->alumni_id )->first();
                    $alumnidetails = Employability::where("alumni_id", $request->alumni_id )->first();
                    


                        if( count( $campanyDetails ) != 0 || $campanyDetails != null )
                        {

                                $campanyDetails->job_title = $request->job_title;
                                $campanyDetails->Company_connected = $request->Company_connected;
                                $campanyDetails->company_phone_number = $request->company_phone_number;
                                $campanyDetails->company_address = $request->company_address;
                                $campanyDetails->alumni_id = $request->alumni_id;
                                $campanyDetails->employee_relation = "Related";

                                $campanyDetails->update();

                                $alumnidetails->Employment = $request->Employment;
                                $alumnidetails->update();



                        }else{

                            $campDetails = new CompanyDetails();
                            
                            $campDetails->job_title = $request->job_title;
                            $campDetails->Company_connected = $request->Company_connected;
                            $campDetails->company_phone_number = $request->company_phone_number;
                            $campDetails->company_address = $request->company_address;
                            $campDetails->alumni_id = $request->alumni_id;
                            $campDetails->employee_relation = "Related";


                            $campDetails->save();

                            $alumnidetails->Employment = $request->Employment;
                            $alumnidetails->update();


                        }



                    $alumni = alumni::where('id', $request->alumni_id)->first();
                    $alumni->Account=1;
                    $alumni->update();

                    return response()->json(['success'=> "success" ]);

                }
                else
                {
                return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
                }



            }







        public function EmploymentInfoSurvey_Step2_Others(Request $request)
        {


                $validator = Validator::make($request->all(),[

                  'job_title' => 'required|string|min:2',
                  'Company_connected' => 'required|string|min:2',
                  'company_phone_number' => 'required|numeric|min:2',
                  'company_address' => 'required|string|min:2',
                  'other_Job_Info' => 'required|string|min:2'
                 
                ]);
                
                if ($validator->passes()) 
                {


                    $campanyDetails = CompanyDetails::where("alumni_id", $request->alumni_id )->first();
                    $alumnidetails = Employability::where("alumni_id", $request->alumni_id )->first();


                    if( count( $campanyDetails ) != 0 || $campanyDetails != null )
                    {

                        $campanyDetails->job_title = $request->other_Job_Info;
                        $campanyDetails->Company_connected = $request->Company_connected;
                        $campanyDetails->company_phone_number = $request->company_phone_number;
                        $campanyDetails->company_address = $request->company_address;
                        $campanyDetails->alumni_id = $request->alumni_id;
        

                        $campanyDetails->employee_relation = "Unrelated";
                        $campanyDetails->update();


                    }else{

                        $campDetails = new CompanyDetails();
                        
                        $campanyDetails->job_title = $request->other_Job_Info;
                        $campDetails->Company_connected = $request->Company_connected;
                        $campDetails->company_phone_number = $request->company_phone_number;
                        $campDetails->company_address = $request->company_address;
                        $campDetails->alumni_id = $request->alumni_id;

                        $campanyDetails->employee_relation = "Unrelated";
                        $campDetails->save();

                    }


                    $alumnidetails->Employment = $request->Employment;
                    $alumnidetails->update();

                    $alumni = alumni::where('id', $request->alumni_id)->first();
                    $alumni->Account=1;
                    $alumni->update();

                    return response()->json(['success'=> "success" ]);

                }
                else
                {
                return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
                }



            }



        public function EmploymentInfoSurvey_Not_Employed(Request $request)
        {


            $alumnidetails = Employability::where("alumni_id", $request->alumni_id )->first();
            $campanyDetails = CompanyDetails::where("alumni_id", $request->alumni_id )->first();
            $alumnidetails->Employment = $request->Employment;
            $alumnidetails->update();

            if( !empty( $campanyDetails )){
                $campanyDetails->delete();
            }


            return response()->json(['success'=> "success" ]);



        }








      public function MyProfile()
        {
            return view('alumni.alumni-profile');
        }

     public function alumnisurvey()
        {
            return view('alumni.alumnisurvey');
        }

     public function viewEvent()
        {
          
          $user = alumni::where('id', Auth::user()->alumni_id )->first();

         $events = DB::table('events')
            ->where( 'events.eventBatch', 'LIKE', '%'. $user->Year_Graduated .'%' )
            ->get();

            return view('alumni.events.eventView',compact( 'events'));
        }







    public function viewActivities()
        {
            $events = Events::all();
            return view('alumni.alumni-activities', compact('events'));
        }





    public function viewOfficers()
        {
            $positions = DB::table('positions')
                ->select('alumni.id as alumni_id','users.avatar as avatar','alumni.First_Name','alumni.Last_Name','alumni.Middle_Name', 'positions.position', 'alumni.Email', 'positions.id as position_id')
                ->leftjoin('alumniofficers', 'alumniofficers.position_id', '=', 'positions.id')
                ->leftjoin('alumni', 'alumni.id', '=', 'alumniofficers.alumni_id')
                ->leftjoin('users', 'users.alumni_id', '=', 'alumni.id')
                ->get();


          return view('alumni.officers', compact('positions'));
        }
        









    public function batchmates()
    {

        $user = alumni::where('id', Auth::user()->alumni_id )->first();

         $batchmates = DB::table('alumni')
            ->leftjoin('users', 'users.alumni_id', '=', 'alumni.id')
            ->where('alumni.Year_Graduated', $user->Year_Graduated)
            ->get();

        return view('alumni.batchmates',compact( 'batchmates' ));
    }


public function notable()
    {

        return view('alumni.alumniNotable',compact( 'notable' ));
    }



















         }


          

