<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor_permit extends Model
{

    public function vendors(){
        return $this->hasManyThrough('App\Vendor', 'App\Vendor_project');
    }

    protected $guarded = [];
}
