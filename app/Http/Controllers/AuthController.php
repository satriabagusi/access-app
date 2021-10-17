<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{

    public function login(){
        return view('auth.login');
    }

    public function __login(Request $request){
        if ($request->except('_token')) {
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {
                return redirect(URL::to('/dashboard'));
            }else{
                return redirect(URL::to('/login'))->with('error', 'Username/Password salah');
            }

        }else{
            return redirect(URL::to('/login'))->with('error', 'Masukan Username/Password');
        }
    }

    public function logout(){
        if(Auth::logout()){
            return redirect(URL::to('/login'))->with('success', 'Berhasil logout');
        }else{
            return redirect(URL::to('/dashboard'))->with('error', 'Gagal melakukan logout');
        }
    }


}
