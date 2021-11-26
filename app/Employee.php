<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

    public function departments(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function daily_check_ups(){
        return $this->hasMany('App\DailyCheckUp');
    }

    public function access_history(){
        return $this->hasMany('App\Access_history');
    }

    protected $guarded =
    [

    ];
}
