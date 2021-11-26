<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access_history extends Model
{
    protected $guarded = [

    ];

    public function employees(){
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }
}
