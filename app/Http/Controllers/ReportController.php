<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ReportController extends Controller
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
    public function reports()
    {
              //Get the number of every year graduated
        $years = DB::table('alumni')
              ->select(DB::raw('(Year_Graduated) as year'))
              ->distinct(DB::raw('(Year_Graduated)'))
              ->latest()
              ->get();

        $years = collect($years);
        $years = $years->pluck('year');


         return view('admin.reports',compact('years' ));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports_filter( Request $request )
    {

       
       if( $request->filter_by == "ALUMNI"){


        $alumni = $this->fetch_filter_request_alumni( $request->filter_by, $request->filter_by_alumni,$request->filter_alumni_by_year, $request->filter_by_employment, $request->filter_by_job_relevance);
         

          $content = view('admin.partials.alumni_report_table')->with(compact('alumni'))->render();



          $title = $request->filter_by_alumni . " ALUMNI RECORDS";

          $count = count($alumni) . ' records found.';

          $printed_by = "Printed by : " . Auth::user()->lastname . ', ' .Auth::user()->firstname;

          return response()->json(['content'=> $content, 'title'=>$title , 'count' => $count, 'printed_by' => $printed_by ]);

       }else{

          $users = $this->fetch_filter_request_user( $request->filter_by_user_role, $request->filter_by_user_status );

          $content = view('admin.partials.user_report_table')->with(compact('users'))->render();

          $role = "";
          $status = $request->filter_by_user_status;
          $title = "";

          if( $request->filter_by_user_role == '2') $role = "ADMIN";
          else if( $request->filter_by_user_role == '3') $role = "STAFF";
          else if( $request->filter_by_user_role == '4') $role = "ALUMNI";
          else $role = "USER";

          if( $request->filter_by_user_status == 'ALL') $status = "";


          $title = $status . " " . $role . " RECORDS";

          $count = count($users) . ' records found.';

          $printed_by = "Printed by :" . Auth::user()->lastname . ', ' .Auth::user()->firstname;

          return response()->json(['content'=> $content, 'title'=>$title , 'count' => $count, 'printed_by' => $printed_by ]);

       }



        
    }



    public function fetch_filter_request_alumni( $filter_by, $filter_by_alumni, $filter_alumni_by_year,$filter_by_employment, $filter_by_job_relevance)
    {

          $alumni = DB::table('alumni')
            ->when( $filter_by_employment , function( $query ) use ( $filter_by_employment ){

              if( $filter_by_employment != "ALL"){

                return $query->join('employability', 'employability.alumni_id', '=', 'alumni.id')->where('employability.Employment', $filter_by_employment );

              }
              return $query->leftjoin('employability', 'employability.alumni_id', '=', 'alumni.id');

            })
            ->when( $filter_by_job_relevance , function( $query ) use ( $filter_by_job_relevance ){

              if( $filter_by_job_relevance != "ALL"){

                return $query->join('companydetails', 'companydetails.alumni_id', '=', 'alumni.id')->where('companydetails.Employee_relation', $filter_by_job_relevance );

              }

                return $query->leftjoin('companydetails', 'companydetails.alumni_id', '=', 'alumni.id');

            })
           ->when( $filter_by_alumni , function( $query ) use ( $filter_by_alumni ){

              if( $filter_by_alumni != "ALL"){

                if( $filter_by_alumni == "TRACED" ){ $filter_by_alumni = 1; }else{ $filter_by_alumni = 0; }
                return $query->where('alumni.Account', $filter_by_alumni );

              }

            })
            ->when( $filter_alumni_by_year , function( $query ) use ( $filter_alumni_by_year ){

              if( $filter_alumni_by_year != "ALL"){

                return $query->where('alumni.Year_Graduated', $filter_alumni_by_year );

              }

            })
            ->get();

            return $alumni;



        
    }




    public function fetch_filter_request_user( $filter_by_user_role, $filter_by_user_status )
    {

            $users = DB::table('users')
            ->when( $filter_by_user_status , function( $query ) use ( $filter_by_user_status ){

              if( $filter_by_user_status != "ALL"){


                if( $filter_by_user_status == "ACTIVE" ){ $filter_by_user_status = "1"; }else{ $filter_by_user_status = "0"; }
                return $query->where('users.status', $filter_by_user_status );

              }

            })
            ->when( $filter_by_user_role , function( $query ) use ( $filter_by_user_role ){

              if( $filter_by_user_role != "ALL"){

                return $query->where('users.role_id', $filter_by_user_role );

              }

            })

            ->get();

            return $users;



        
    }








}

