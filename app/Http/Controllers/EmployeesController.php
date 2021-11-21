<?php

namespace App\Http\Controllers;

use App\Access_user;
use App\Department;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employees = Employee::paginate(10);
        $employees = Employee::with(['departments'])->paginate(5);
        return view('admin.employee-data', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Department::all();
        return view('admin.add-employee', compact('department'));
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
            'uuid_card' => 'required|max:12|alpha_num',
            'name' => 'required',
            'employee_number' => 'required|numeric|digits_between:6,12',
            'department_id' => 'required',
            'division' => 'required|alpha_num',
            'company' => 'required',
        ],
        [
            'uuid_card.required' => 'Nomor Kartu kosong.',
            'uuid_card.max' => 'Format Nomor Kartu tidak sesuai.',
            'uuid_card.alpha_num' => 'Format nomor kartu tidak sesuai',
            'name.required' => 'Nama Pegawai Kosong',
            'employee_number.required' => 'Nomor Pegawai kosong.',
            'employee_number.numeric' => 'Format Nomor Pegawai tidak sesuai',
            'employee_number.digits_between' => 'Format Nomor Pegawai tidak sesuai.',
            'department_id.required' => 'Departemen belum terpilih.',
            'division.required' => 'Bagian/Fungsi kosong.',
            'division.alpha_num' => 'Format penulisan Bagian/Fungsi tidak sesuai',
            'company.required' => 'Nama Perusahaan kosong.',
        ]
        );


        if(!$validator->fails()){

            $insert = Employee::create([
                'uuid_card' => $request->uuid_card,
                'name' => $request->name,
                'division' =>  $request->division,
                'company' => $request->company,
                'employee_number' => $request->employee_number,
                'department_id' => $request->department_id,
            ]);

            if($insert){
                return redirect('/dashboard/employee')->with('success', 'Berhasil Input data Pegawai');
            }else{
                return redirect('/dashboard/employee')->with('error', 'Gagal Input data Pegawai');
            }


        }else{
            return redirect(URL::to('/dashboard/employee/add'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Employee::destroy($id);
        if($data){
            return redirect(URL::to('/dashboard/employee'))->with('success', 'Berhasil menghapus data.');
        }else{
            return redirect(URL::to('/dashboard/employee'))->with('error', 'Gagal menghapus data.');
        }
    }

    public function checkEmployee(Request $request){
        $uid = $request->uuid_card;
        if ($request->has('uuid_card') && $uid !== null) {

            $checkEmployee = Employee::with(['departments'])
                                ->with(['daily_check_ups' => function($q) {
                                    $q->latest()->first();
                                }])
                                ->where('uuid_card', $uid)->first();

            if($checkEmployee){
                $access = Access_user::where('uuid_card', $uid)->first();
                return Response::json(['status' => 200, 'message' => 'Success', 'data' => $checkEmployee, 'access' => $access]);
            }else{
                return Response::json(['status' => 404, 'message' => 'Pegawai tidak terdaftar']);
            }

        }else{

            return Response::json(['status' => 403, 'message' => 'Access Forbidden']);

        }
    }
}
