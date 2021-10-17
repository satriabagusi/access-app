<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $username, $password;


    public function login(){
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['username' => $this->username, 'password' => $this->password])){
            return redirect()->to('/dashboard');
        }else{
            session()->flash('error');
            return redirect()->to('/login');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->extends('layouts.app')
            ->section('content');
    }
}
