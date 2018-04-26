<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable=[ 
    	'title','venue','time', 'date','description','evenBatch',
    ];

     public $table = "events";
}
