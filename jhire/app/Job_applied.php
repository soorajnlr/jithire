<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_applied extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

  	protected $table = 'Job_applied';

    protected $fillable = [
        'user_id','applied_job_id','comp_id','job_status','applied_date','status','file' 


    ];
}
