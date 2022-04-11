<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera_gate extends Model
{
    protected $guarded = [];

    public function camera_ip_addresses(){
        return $this->hasMany('App\Camera_ip_address');
    }
}
