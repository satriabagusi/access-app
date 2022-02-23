<?php

namespace App\Http\Controllers;

use App\Access_user;
use App\DailyCheckUp;
use App\Employee;
use App\Exports\DailyCheckUpsExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DailyCheckUpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dcu = DailyCheckUp::with(['employees.departments'])->paginate(10);
        return view('admin.history.dailychekup-history', compact('dcu'));
    }

    public function exportDCU(Request $request){
        $month = $request->month;
        // return $request->all();
        if($request){
            return Excel::download(new DailyCheckUpsExport($request), 'daily_check_up_report-'.Carbon::now()->toDateString().'.xlsx');
        }else{
            $month = Carbon::now()->month;
            return Excel::download(new DailyCheckUpsExport($month), 'daily_check_up_report-'.Carbon::now()->toDateString().'.xlsx');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dcu.dailycheckup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->uuid_card;
        // return substr(dechex($data), 3, 5);
        // return $request->all();

        $validator = Validator::make($request->all(),
        [
            'uuid_card' => 'required|alpha_num|max:12',
            'blood_pressure' => 'required',
            'temperature' => 'required',
            'fit_status' => 'required|boolean',
        ],
        [
            'uuid_card.required' => 'Nomor kartu kosong.',
            'uuid_card.alpha_num' => 'Format nomor kartu tidak sesuai.',
            'uuid_card.max' => 'Format nomor kartu tidak sesuai.',
            'blood_pressure.required' => 'Kolom tekanan darah kosong.',
            'temperature.required' => 'Kolom suhu kosong.',
            'fit_status.required' => 'Status Fit tidak terpilih.',
            'fit_status.boolean' => 'Fit Status tidak sesuai.',
        ]);

        if(!$validator->fails()){
            $employee = Employee::where('uuid_card', $request->uuid_card)->first();
            $dcu = DailyCheckUp::where('employee_id', $employee->id)->latest()->first();
            // return $dcu;

            if($dcu && Carbon::now()->diffInHours($dcu->created_at) < 8){
                return redirect(URL::to('/dashboard/input-dcu'))->with('error', 'Pegawai sudah melakukan Daily Check Up per 8 jam.');
            }else{
                $checkAccess = Access_user::where('uuid_card', $request->uuid_card)->first();
                if($checkAccess){
                    if($checkAccess->status == 0 || $checkAccess->dcu_check == 0){
                        if($employee){
                            DB::beginTransaction();
                            try {
                                if($checkAccess && $checkAccess->safetytalk_check == 1){
                                    Access_user::where('uuid_card', $request->uuid_card)
                                                ->update([
                                                        'dcu_check' => 1,
                                                        'status' => 1,
                                                    ]);
                                }else if(!$checkAccess){
                                    Access_user::create([
                                        'uuid_card' => $request->uuid_card,
                                        'dcu_check' => 1,
                                        'status' => 0,
                                    ]);
                                }
                                DailyCheckUp::create([
                                    'blood_pressure' => $request->blood_pressure,
                                    'temperature' => $request->temperature,
                                    'employee_id' => $employee->id,
                                    'fit_status' => $request->fit_status,
                                ]);

                                DB::commit();
                                return redirect(URL::to('/dashboard/input-dcu'))->with('success', 'Berhasil input data DCU');
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                return redirect(URL::to('/dashboard/input-dcu'))->with('error', 'Gagal melakukan input data DCU');
                            }
                        }else{
                            return redirect(URL::to('/dashboard/input-dcu'))->with('error', 'Nomor Kartu/Pegawai belum terdaftar pada database.');
                        }
                    }else{
                        return redirect(URL::to('/dashboard/input-dcu'))->with('error', 'Pegawai Sudah melakukan Daily Check Up hari ini');
                    }
                }else{
                    DB::beginTransaction();
                    try{
                        DailyCheckUp::create([
                            'blood_pressure' => $request->blood_pressure,
                            'temperature' => $request->temperature,
                            'employee_id' => $employee->id,
                            'fit_status' => $request->fit_status,
                        ]);

                        if($employee->department_id !== 3){
                            Access_user::create([
                                'uuid_card' => $request->uuid_card,
                                'dcu_check' => 1,
                                'safetytalk_check' => 1,
                                'status' => 1,
                            ]);
                        }else{
                            Access_user::create([
                                'uuid_card' => $request->uuid_card,
                                'safetytalk_check' => 0,
                                'dcu_check' => 1,
                            ]);
                        }

                        DB::commit();
                        return redirect(URL::to('/dashboard/input-dcu'))->with('success', 'Berhasil input data DCU');
                    } catch (\Throwable $th){
                        DB::rollBack();
                        return redirect(URL::to('/dashboard/input-dcu'))->with('error', 'Gagal melakukan input data DCU');
                    }
                }
            }
        }else{
            return redirect(URL::to('/dashboard/input-dcu'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kolom kembali');
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
        //
    }

    public function checkDataDcu(Request $request){
        $uid = $request->uuid_card;
        if ($request->has('uuid_card') && $request->uuid_card !== null) {
            $checkAccess = Access_user::where('uuid_card', $uid)->first();
            if($checkAccess){
                $employees = Employee::with(['departments'])->where('uuid_card', $uid)->first();
                if($employees){
                    return Response::json(['status' => 200, 'message' => 'Success', 'data' => $employees]);
                }else{
                    return Response::json(['status' => '404', 'message' => 'Pegawai tidak terdaftar']);
                }
            }else{
                return Response::json(['status' => '404', 'message' => 'Pegawai belum melakukan DCU' ]);
            }

        }else{
            return Response::json(['status' => '403', 'message' => 'Access Forbidden']);
        }
    }

    public function safetyTalk(){
        return view('admin.safetytalk.safetytalk');
    }

    public function submitSafetytalk(Request $request){
        if($request->uuid_card){
            $uuid = $request->uuid_card;
            // return $uuid;
            $access = Access_user::where('uuid_card', $request->uuid_card)->first();
            // return redirect(URL::to('/dashboard/safetytalk'))->with('error', 'Sudah melakukan Safetytalk');

            if(!$access){
                DB::beginTransaction();
                try{
                    Access_user::create([
                        'uuid_card' => $uuid,
                        'safetytalk_check' => 1,
                        'status' => 0
                    ]);
                    DB::commit();
                    return redirect(URL::to('/dashboard/safetytalk'))->with('success', 'Berhasil melakukan Safetytalk');
                }catch (\Throwable $th){
                    return redirect(URL::to('/dashboard/safetytalk'))->with('error', 'Gagal melakukan Safetytalk');
                    // return $th;
                }
            }else if($access && $access->safetytalk_check == 0){
                if($access->dcu_check == 1){
                    $status = 1;
                }else{
                    $status = 0;
                }

                DB::beginTransaction();
                try{
                    Access_user::where('uuid_card', $uuid)
                                ->update([
                                    'safetytalk_check' => 1,
                                    'status' => $status,
                                ]);
                    DB::commit();
                    return redirect(URL::to('/dashboard/safetytalk'))->with('success', 'Berhasil melakukan Safetytalk');
                } catch (\Throwable $th){
                    DB::rollBack();
                    return redirect(URL::to('/dashboard/safetytalk'))->with('error', 'Gagal melakukan Safetytalk');
                }
            }else if($access && $access->safetytalk_check == 1){
                return redirect(URL::to('/dashboard/safetytalk'))->with('success', 'Sudah melakukan Safetytalk');
            }

        }
    }

}
