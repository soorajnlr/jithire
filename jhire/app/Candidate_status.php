<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate_status extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'candidate_status';
    protected $fillable = [
        'candidate_status', 'status_type','visible'
    ];
}