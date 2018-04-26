<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumniPosition extends Model
{
    protected $fillable=[ 
    	'alumni_id','position_id',
    ];

     public $table = "alumniofficers";
}
