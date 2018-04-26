<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alumni;
use DB;

class DashboardController extends Controller
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
    public function dashboard()
    {

        //Get the number of every year graduated
        $years = DB::table('alumni')
              ->select(DB::raw('(Year_Graduated) as year'))
              ->distinct(DB::raw('(Year_Graduated)'))
              ->latest()
              ->get();

        $years = collect($years);
        $years = $years->pluck('year');




        $data = [];

        $graduate = [];
        $unemployed = [];
        $employed = [];
        $alumni_traced = [];
        $alumni_untraced = [];
        $alumni_related = [];
        $alumni_notrelated = [];

       $selected_year = [];

         foreach($years as $Year_Graduated)
          {

            $temp = DB::table('alumni')
              ->select('Year_Graduated')
              ->where('Year_Graduated', $Year_Graduated)
              ->get();

            array_push($data,$temp);
            array_push($graduate,count($temp));


            return view('admin.dashboard', compact( "years") );
        }
    }




}
