<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_details extends Model
{
    //

     protected $table = 'company_details';
       public $timestamps = false;

    protected $fillable = [
        'user_id','company_name','url', 'city','state','TAN','country','poc_name','phone_no','role','status','email','password','date_time'
    ];
}
