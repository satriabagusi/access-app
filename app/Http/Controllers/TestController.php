<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function dcu(Request $request){
        if($request->id == 1){
            $panel = 'Restricted Area';
        }elseif($request->id == 2){
            $panel = 'Office';
        }elseif($request->id == 3){
            $panel = 'All Area are Granted ';
        }else{
            $panel = 'Access Not Found !';
        }

        if($request->uuid == '325fc3' && $request->id == 1){
            return '200';
        }else{
            return '404';
        }
    }
}
