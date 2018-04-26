<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employability extends Model
{
    protected $fillable=[ 
    	 'Address', 'Home_Phone', 'Mobile_Phone', 'Employment',

    ];

    public $table = "employability";
}
