<?php

namespace App\Http\Controllers;

use App\Permit_type;
use App\Vendor;
use App\Vendor_permit;
use App\Vendor_project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Madnest\Madzipper\Facades\Madzipper;

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
        $project = Vendor_project::where('id', $id)->with(['vendors'])->first();
        $permit = Vendor_permit::where('vendor_project_id', $id)->get();
        $csms = Vendor_permit::where('vendor_project_id', $id)->where('permit_type_id', 1)->get();
        $jsa = Vendor_permit::where('vendor_project_id', $id)->where('permit_type_id', 2)->get();
        $hse_plan = Vendor_permit::where('vendor_project_id', $id)->where('permit_type_id', 3)->get();
        $form_permit = Vendor_permit::where('vendor_project_id', $id)->where('permit_type_id', 4)->get();
        return view('admin.permit.permit-list', compact('project','permit', 'project', 'csms', 'jsa', 'hse_plan', 'form_permit'));
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

    public function downloadZip($permit_type, $project_id){
        // if (true === ($zip->open('ReportesTodos.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE))) {
        //     foreach (Storage::allFiles('public') as $file) {
        //         $name = basename($file);
        //         if ($name !== '.gitignore') {
        //             $zip->addFile(public_path('storage\' . $name), $name);
        //         }
        //     }
        //     $zip->close();
        // }

        $permit_type = Crypt::decrypt($permit_type);
        $project_id = Crypt::decrypt($project_id);

        $permit_name = Permit_type::where('id', $permit_type)->pluck('permit_name')->first();
        $project = Vendor_project::where('id', $project_id)->first();
        $vendor = Vendor::where('id', $project->vendor_id)->first();

        $permit_files = Vendor_permit::where('permit_type_id', $permit_type)
                        ->where('vendor_project_id', $project_id)->pluck('file_name')->toArray();

        foreach($permit_files as $key => $value){
            $permit_files[$key] = str_replace('public', 'storage', $value);
        }

        // return $permit_files;

        $fileName = $vendor->vendor_name.'-'.$permit_name.'-'.str_replace('/', '-', $project->contract_number).'.zip';

        // $zip = Zip::create(Storage::putFile('public/permit_files/zip/'.str_replace('/', '-', $project->contract_number), $fileName), true);

        $zipper = new \Madnest\Madzipper\Madzipper;
        $zipper->make('storage/permit_file/zip/'.$fileName)->add($permit_files);
        $zipper->close();

        return redirect(URL::to(Storage::url('public/permit_file/zip/'.$fileName)));
    }
}
