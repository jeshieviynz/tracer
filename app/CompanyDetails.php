<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    protected $fillable=[ 
    	'job_title','Company_connected', 'company_phone_number', 'company_address','employee_relation'
    ];
    
     public $table = "companydetails";
}
