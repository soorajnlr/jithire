<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_posting extends Model
{
    //

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

  	protected $table = 'job_posting';

    protected $fillable = [
        'Job_code','job_role','job_type','min_exp','max_exp','primary_skill','skills','skill1','skill2','skill3','skill4','skill5','job_description','preferred_location','no_positions','duration','salary_lakhs','salary_thousands','company_id','status','pen_date_time','close_date_time'


    ];
}
