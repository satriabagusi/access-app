<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //

    public function vendor_projects(){
        return $this->hasMany('App\Vendor_project');
    }

    public function vendor_permits(){
        return $this->hasManyThrough('App\Vendor_permit', 'App\Vendor_project');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }

    protected $guarded = [];
}
