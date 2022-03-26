<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PagesController extends Controller
{
    public function dashboard(){
        if(Auth::user()->user_role_id <= 3){
            return view('admin.home');
        }else{
            Auth::logout();
            return redirect(URL::to('/'))->with('error', 'Silahkan login menggunakan akun Admin');
        }
    }

    public function monitorSegel(){
        return view('admin.seal-monitoring.monitor-segel');
    }

    public function portal(){
        return view('auth.portal');
    }

    public function vendorDashboard(){
        if(Auth::user()->user_role_id == 4){
            return view('vendor.home');
        }else{
            Auth::logout();
            return redirect(URL::to('/vendor/login'))->with('error', 'Silahkan login menggunakan akun Admin');
        }
    }
}
