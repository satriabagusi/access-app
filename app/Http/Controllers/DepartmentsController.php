<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::paginate(10);
        return view('admin.department', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.add-department');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'department' => 'required|alpha_num|unique:departments',
            ],
            [
                'department.required' => 'Nama Departemen kosong.',
                'department.alpha_num' => 'Format tidak sesuai.',
                'department.unique' => 'Nama Departemen sudah terdaftar.',
            ]
        );

        if($validator->fails()){
            return redirect(URL::to('/dashboard/department/add'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
        }else{
            $department = Department::create([
                'department' => $request->department,
            ]);

            if($department){
                return redirect(URL::to('/dashboard/department'))->with('success', 'Berhasil update data departemen');
            }else{
                return redirect(URL::to('/dashboard/department/add'))->with('error', 'Gagal melakukan update data departemen')->withErrors($validator)->withInput($request->all());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::where('id', $id)->first();
        return view('admin.edit-department', compact('department'));
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
        $validator = Validator::make($request->all(),
        [
            'department' => 'required|alpha_num',
        ],
        [
            'department.required' => 'Nama Departemen kosong.',
            'department.alpha_num' => 'Format tidak sesuai.',
        ]
        );

        if($validator->fails()){
            return redirect(URL::to('/dashboard/department/edit/'.$request->id))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
        }else{
            $department = Department::where('id', $request->id)
            ->update(['department' => $request->department]);

            if($department){
                return redirect(URL::to('/dashboard/department'))->with('success', 'Berhasil update data departemen');
            }else{
                return redirect(URL::to('/dashboard/department/edit/'.$request->id))->with('error', 'Gagal melakukan update data departemen');
            }
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

    }
}
