<?php

namespace App\Http\Controllers;

use App\Access_user;
use App\DailyCheckUp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    //

    public function display(){
        $total_dcu = DailyCheckUp::where('created_at', Carbon::today())->count();
        $total_restrictArea = Access_user::count();
        $total_fit = DailyCheckUp::where('fit_status', 0)->where('created_at', Carbon::today())->count();
        $total_unfit = DailyCheckUp::where('fit_status', 1)->where('created_at', Carbon::today())->count();
        return view('access.display', compact('total_dcu', 'total_restrictArea', 'total_fit', 'total_unfit'));
    }

    public function access(){
        return view('access.access');
    }
}
