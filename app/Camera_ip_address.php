<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera_ip_address extends Model
{
    protected $guarded = [];

    public function camera_gates(){
        return $this->belongsTo('App\Camera_gate');
    }
}
