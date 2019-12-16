<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proficiency extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'proficiency';

    protected $fillable = [
        'proficiency'
    ];
}
