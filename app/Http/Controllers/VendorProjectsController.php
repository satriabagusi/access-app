<?php

namespace App\Http\Controllers;

use App\Vendor_project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class VendorProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Vendor_project::where('vendor_id', Auth::user()->vendors->id)->get();
        return view('vendor.project.project-list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.project.add-project');
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
                'project_name' => 'required',
                'contract_number' => 'required',
                'contract_start' => 'required|date|before:contract_end',
                'contract_end' => 'required|date|after:contract_start',
            ],
            [
                'project_name.required' => 'Kolom Nama Pekerjaan kosong.',
                'contract_start.required' => 'Kolom Tanggal Mulai Pekerjaan kosong.',
                'contract_start.date' => 'Format Tanggal Mulai Pekerjaan tidak sesuai.',
                'contract_start.before' => 'Tanggal Mulai Pekerjaan melewati Tanggal Pekerjaan berakhir.',
                'contract_end.required' => 'Kolom Tanggal Berakhir Pekerjaan kosong.',
                'contract_end.date' => 'Format Tanggal Berakhir Pekerjaan tidak sesuai.',
                'contract_end.after' => 'Tanggal berakhir Pekerjaan melewati Tanggal Mulai Pekerjaan.',
            ]
        );

        if(!$validator->fails()){
            // return $request->all();
            // return Auth::user()->vendors->id;

            $insert = Vendor_project::create([
                'project_name' => $request->project_name,
                'contract_number' => $request->contract_number,
                'contract_start' => $request->contract_start,
                'contract_end' => $request->contract_end,
                'vendor_id' => Auth::user()->vendors->id,
                'status' => 0
            ]);

            if($insert){
                return redirect(URL::to('/vendor/project-list'))->with('success', 'Berhasil mendaftarkan data Pekerjaan');
            }else{
                return redirect(URL::to('/vendor/project-list'))->with('danger', 'Gagal mendaftarkan data Pekerjaan');
            }
        }else{
            return redirect(URL::to('/vendor/add-project'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
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
        $id = Crypt::decrypt($id);
        $project = Vendor_project::where('id', $id)->first();
        return view('vendor.project.project-detail', compact('project'));
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
    public function update(Request $request)
    {
        // return $request;

        $validator = Validator::make($request->all(),
            [
                'project_name' => 'required',
                'contract_number' => 'required',
                'contract_start' => 'required|date|before:contract_end',
                'contract_end' => 'required|date|after:contract_start',
            ],
            [
                'project_name.required' => 'Kolom Nama Pekerjaan kosong.',
                'contract_start.required' => 'Kolom Tanggal Mulai Pekerjaan kosong.',
                'contract_start.date' => 'Format Tanggal Mulai Pekerjaan tidak sesuai.',
                'contract_start.before' => 'Tanggal Mulai Pekerjaan melewati Tanggal Pekerjaan berakhir.',
                'contract_end.required' => 'Kolom Tanggal Berakhir Pekerjaan kosong.',
                'contract_end.date' => 'Format Tanggal Berakhir Pekerjaan tidak sesuai.',
                'contract_end.after' => 'Tanggal berakhir Pekerjaan melewati Tanggal Mulai Pekerjaan.',
            ]
        );

        if(!$validator->fails()){
            // return $request->all();
            // return Auth::user()->vendors->id;

            $insert = Vendor_project::where('id', $request->id)
                    ->update([
                        'project_name' => $request->project_name,
                        'contract_number' => $request->contract_number,
                        'contract_end' => $request->contract_end,
                        'contract_start' => $request->contract_start,
                    ]);

            if($insert){
                return redirect(URL::to('/vendor/project-list'))->with('success', 'Berhasil Update data Pekerjaan');
            }else{
                return redirect(URL::to('/vendor/project-list'))->with('danger', 'Gagal update data Pekerjaan');
            }
        }else{
            return redirect(URL::to('/vendor/project/detail/'.Crypt::encrypt($request->id)))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
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

    public function projectList(){
        $projects = Vendor_project::all();
        return view('admin.permit.project-list', compact('projects'));
    }
}
