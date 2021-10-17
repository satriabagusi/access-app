<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Dailycheckup extends Component
{
    public function render()
    {
        return view('livewire.admin.dailycheckup')
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
