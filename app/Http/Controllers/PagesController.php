<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard(){
        return view('admin.home');
    }

    public function monitorSegel(){
        return view('admin.monitor-segel');
    }
}
