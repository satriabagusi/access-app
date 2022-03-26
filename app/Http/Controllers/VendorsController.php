<?php

namespace App\Http\Controllers;

use App\User;
use App\Vendor;
use App\Vendor_project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class VendorsController extends Controller
{

    public function login(){
        return view('auth.vendor-login');
    }

    public function __login(Request $request){
        if ($request->except('_token')) {
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {
                if(Auth::user()->user_role_id == 4){
                    return redirect(URL::to('/vendor/home'));
                }else{
                    Auth::logout();
                    return redirect(URL::to('/'))->with('error', 'Silahkan login menggunakan akun Vendor');
                }
            }else{
                return redirect(URL::to('/vendor/login'))->with('error', 'Username/Password salah');
            }

        }else{
            return redirect(URL::to('/vendor/login'))->with('error', 'Masukan Username/Password');
        }
    }

    public function register(){
        return view('auth.vendor-register');
    }

    public function __register(Request $request){
        $validator = Validator::make($request->all(),
            [
                'username' => 'required|alpha_num|max:20',
                'password' => 'required',
                'vendor_name' => 'required',
                'vendor_email' => 'required|unique:vendors,email|email',
            ],
            [
                'username.required' => 'Kolom username kosong.',
                'username.alpha_num' => 'Format username tidak sesuai.',
                'username.max' => 'Maksimum jumlah username 20 karakter',
                'password.required' => 'Kolom password kosong.',
                'vendor_name.required' => 'Kolom nama vendor kosong.',
                'vendor_email.required' => 'Kolom email vendor kosong.',
                'vendor_email.unique' => 'Email vendor sudah dipakai.',
                'vendor_email.email' => 'Format email vendor tidak sesuai.',
            ]

        );
        if(!$validator->fails()){

            // return $request->username;
            $insertUser = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'user_role_id' => '4'
            ]);
            $insertVendor = Vendor::create([
                'vendor_name' => $request->vendor_name,
                'email' => $request->vendor_email,
                'user_id' => $insertUser->id,
            ]);

            if($insertUser && $insertVendor){
                return redirect('/vendor/login')->with('success', 'Berhasil melakukan registrasi akses login');
            }else{
                return redirect('/vendor/register')->with('danger', 'Gagal melakukan registrasi akses login');
            }

        }else{
            return redirect(URL::to('/vendor/register'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::paginate(10);
        return view('admin.permit.vendor-data', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $vendors = Vendor::where('id', $id)->first();
        $projects = Vendor_project::where('vendor_id', $id)->paginate(10);
        return view('admin.permit.vendor-detail', compact('vendors', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('vendor.vendor-profile-detail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;

        $validator = Validator::make($request->all(),
            [
                'username' => 'required|alpha_num|max:20',
                'password' => 'required',
                'vendor_name' => 'required',
                'email' => 'required|email|unique:vendors,email,'.Auth::user()->vendors->id,
            ],
            [
                'username.required' => 'Kolom username kosong.',
                'username.alpha_num' => 'Format username tidak sesuai.',
                'username.max' => 'Maksimum jumlah username 20 karakter',
                'password.required' => 'Kolom password kosong.',
                'vendor_name.required' => 'Kolom nama vendor kosong.',
                'email.required' => 'Kolom email vendor kosong.',
                'email.unique' => 'Email vendor sudah dipakai.',
                'email.email' => 'Format email vendor tidak sesuai.',
            ]

        );
        if(!$validator->fails()){

            // return $request->username;
            $id = Auth::user()->id;
            $updateUser = User::where('id', $id)
                            ->update([
                                'username' => $request->username,
                                'password' => Hash::make($request->password)
                            ]);
            $updateVendor = Vendor::where('user_id', $id)
                            ->update([
                                'vendor_name' => $request->vendor_name,
                                'email' => $request->email
                            ]);
            if($updateUser && $updateVendor){
                return redirect('/vendor/profile')->with('success', 'Berhasil melakukan update profile vendor');
            }else{
                return redirect('/vendor/profile')->with('danger', 'Gagal melakukan update profile vendor');
            }

        }else{
            return redirect(URL::to('/vendor/profile'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
