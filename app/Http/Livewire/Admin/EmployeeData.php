<?php

namespace App\Http\Livewire\Admin;

use App\Department;
use App\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $uuid_card, $name, $employee_number ,$department_id , $department, $employee;

    protected $rules = [
        'uuid_card' => 'required|alpha_num|max:12',
        'name' => 'required|alpha',
        'employee_number' => 'required|alpha_num|max:6',
        'department_id' => 'required',
    ];

    protected $messages = [
        'uuid_card.require' => 'No Kartu Kosong.',
        'uuid_card.alpha_num' => 'Format nomor kartu tidak sesuai.',
        'uuid_card.max' => 'Format nomor kartu tidak sesuai.',
        'name.required' => 'Nama Pegawai kosong.',
        'name.alpha' => 'Format nama tidak sesuai.',
        'employee_number.required' => 'Nomor Pegawai kosong.',
        'employee_number.alpha_num' => 'Format nomor pegawai tidak sesuai.',
        'employee_number.max' => 'Format nomor pegawai tidak sesuai.',
        'department_id.required' => 'Departemen belum dipilih.',
    ];

    public function updated($propertyName){
        return "ok";
        $this->validateOnly($propertyName);
    }

    public function saveEmployee(){
        return "OK";
        $validatedData = $this->validate();

        Employee::create($validatedData);
    }

    public function mount(){
        $this->department = Department::all();
    }

    public function render()
    {
        $employees = Employee::paginate(10);
        return view('livewire.admin.employee-data', compact('employees'))
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
