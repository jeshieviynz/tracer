<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alumni extends Model
{
    protected $fillable=[ 
    	'alumni_id_number','first_name', 'last_name', 'middle_name','address','email', 'birthdate', 'home_phone', 'mobile_phone', 'course', 'year_graduated',
    ];
    public $timestamps=false;

    protected $hidden = [
        'password', 'remember_token',
    ];
     public $table = "alumni";
}
