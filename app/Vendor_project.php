<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor_project extends Model
{

    public function vendors(){
        return $this->belongsTo('App\Vendor', 'vendor_id');
    }

    public function vendor_permits(){
        return $this->hasMany('App\Vendor_permit');
    }

    protected $guarded = [

    ];

}
