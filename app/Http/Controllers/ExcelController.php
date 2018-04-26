<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Excel;
use App\alumni;

class ExcelController extends Controller
{
    public function import()
    {
    	return view('admin.Alumni');
    }

    
    public function postexcel()
    {
    	Excel::load(Input::file('alumni'),function($reader){
    		$reader->each(function($sheet){
    			alumni::firstOrCreate($sheet->toArray());
    		});
    	});
        return back();
        
    }

    public function getExport()
    {
       
        Excel::create('records', function($excel){
            $excel->sheet("alumni", function($sheet){

                $alumni = DB::table('alumnis')
                ->select('alumnis.firstname', 'alumnis.lastname', 'alumnis.student_id', 'alumnis.email')
                ->get();

            $sheet->fromArray( json_decode(json_encode($alumni),true));

            });

        })->export("csv");
    }
}
