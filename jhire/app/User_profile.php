<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_profile';
    protected $fillable = [
        'user_id','name','email','gender','resume_headline','pancard','mobile_number','dob','total_experience','industry','previous_role','job_type','preferred_roles','year_completion','institute','score','degree','branch','current_location','preferred_location','add_domain','salary_lakhs','previous_experience','company','photos','resume','primary_skill','skills','skill1','skill2','skill3','skill4','skill5'

    ];
}
