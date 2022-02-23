<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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

    public function addUser(){
        return view('admin.employee.add-user');
    }

    public function _addUser(Request $request){
        $validator = Validator::make($request->all(),
        [
            'username' => 'required|alpha_num|max:12',
            'password' => 'required',
            'user_role_id' => 'required|numeric',
        ],
        [
            'username.required' => 'Username kosong.',
            'username.alpha_num' => 'Format username tidak sesuai.',
            'username.max' => 'Max karakter username 12',
            'password.required' => 'Password kosong.',
            'user_role_id.required' => 'Jenis user kosong.',
            'user_role_id.numeric' => 'Jenis user tidak sesuai.',
        ]
        );

        if(!$validator->fails()){

            // return $request->username;
            $insert = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'user_role_id' => $request->user_role_id,
            ]);

            if($insert){
                return redirect('/dashboard/add-user')->with('success', 'Berhasil melakukan registrasi akses login');
            }else{
                return redirect('/dashboard/add-user')->with('danger', 'Gagal melakukan registrasi akses login');
            }

        }else{
            return redirect(URL::to('/dashboard/add-user'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
        }

    }


}
