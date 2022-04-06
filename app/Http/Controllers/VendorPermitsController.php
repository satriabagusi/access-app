<?php

namespace App\Http\Controllers;

use App\Permit_type;
use App\Vendor_permit;
use App\Vendor_project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class VendorPermitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.permit.vendor-data');
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
        $validator = Validator::make($request->all(),
            [
                'permit_type_id' => 'required',
                'permit_file' => 'required|mimes:pdf, doc, docx',
            ],
            [
                'permit_type_id.required' => 'Unexpected error.',
                'permit_file.required' => 'File belum dipilih.',
                'permit_file.mimes' => 'Format file tidak sesuai.',

            ]
        );
        if(!$validator->fails()){
            $file = '';
            $permitName = Permit_type::where('id', $request->permit_type_id)->first();
            $project = Vendor_project::where('id', $request->project_id)->first();
            $fileName = $permitName->permit_name.'_'.rand(100, 9999999).'_'.$project->vendors->vendor_name.'.pdf';
            $path = 'public/permit_file/'.str_replace("/", "_", $project->contract_number).'/'.$permitName->permit_name;
            $checkFileName = Vendor_permit::where('file_name', $fileName)->first();
            if($checkFileName){
                $fileName = $permitName->permit_name.'_'.rand(100, 9999999).'_'.$project->vendors->vendor_name.'.pdf';
            }
            if($request->hasFile('permit_file')){
                $request->file('permit_file')->storeAs($path, $fileName);
                $file = $path.'/'.$fileName;
            }

            $insert = Vendor_permit::create([
                'file_name' => $file,
                'permit_type_id' => $request->permit_type_id,
                'vendor_project_id' => $request->project_id
            ]);

            if($insert){
                return redirect(URL::to('/vendor/project/permit/'.Crypt::encrypt($request->project_id)))->with('success', 'Berhasil upload data Permit');
            }else{
                return redirect(URL::to('/vendor/project/permit/'.Crypt::encrypt($request->project_id)))->with('danger', 'Gagal upload data Permit');
            }
        }else{
            return redirect(URL::to('/vendor/project/permit/'.Crypt::encrypt($request->project_id)))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
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
        $permit = Vendor_permit::where('vendor_project_id', $id)->get();
        $project = Vendor_project::where('id', $id)->first();
        $csms = Vendor_permit::where('vendor_project_id', $id)->where('permit_type_id', 1)->get();
        $jsa = Vendor_permit::where('vendor_project_id', $id)->where('permit_type_id', 2)->get();
        $hse_plan = Vendor_permit::where('vendor_project_id', $id)->where('permit_type_id', 3)->get();
        $form_permit = Vendor_permit::where('vendor_project_id', $id)->where('permit_type_id', 4)->get();
        return view('vendor.permit.project-permit', compact('id','permit', 'project', 'csms', 'jsa', 'hse_plan', 'form_permit'));
    }

    public function projectPermit($id){
        $id = Crypt::decrypt($id);
        $project = Vendor_project::where('id', $id)->first();
        $permit = Vendor_permit::where('vendor_project_id', $id)->get();
        return view('admin.permit.permit-list', compact('project','permit'));
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
        $id = Crypt::decrypt($id);
        $permit = Vendor_permit::where('id', $id)->first();
        $test = Storage::delete($permit->file_name);
        $delete = $permit->delete();

        if($test && $delete){
            return redirect(URL::to('/vendor/project/permit/'.Crypt::encrypt($id)))->with('success', 'Berhasil hapus file Permit');
        }else{
            return redirect(URL::to('/vendor/project/permit/'.Crypt::encrypt($id)))->with('danger', 'Gagal hapus file Permit');
        }
    }
}
