<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Total_it_experience extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table ='total_it_experience';
    protected $fillable = [
        'total_experience'
    ];
}
