<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyCheckUp extends Model
{
    //

    public function employees(){
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }

    protected $guarded =[

    ];
}
