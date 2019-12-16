<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_type extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ='job_type';
    
    protected $fillable = [
        'job_type'
    ];
}