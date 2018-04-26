<?php

namespace App\Repositories;
use Vinkla\Hashids\Facades\Hashids;
use App\User;
use App\Role;
use DB;
use Auth;
use Hash;

class alumniRepositories
{
	public function getalumniName($first_name, $last_name, $middle_name, $birthdate)
    {

         $alumnis = DB::table('alumni')
   
              ->where('alumni.First_name', $first_name )
              ->where('alumni.Last_name', $last_name )
              ->where('alumni.Middle_name', $middle_name )
              ->where('alumni.Birthdate', $birthdate )
              ->first();

        return $alumnis;
    }
}