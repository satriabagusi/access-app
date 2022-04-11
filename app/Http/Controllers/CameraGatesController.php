<?php

namespace App\Http\Controllers;

use App\Camera_gate;
use App\Camera_ip_address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class CameraGatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camera = Camera_gate::all();
        return view('admin.seal-monitoring.monitor-segel', compact('camera'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(),
            [
                'gate_number' => 'required|alpha_num|unique:camera_gates,gate_number',
                'ip_camera_top' => 'required|ip|ipv4|unique:camera_ip_addresses,ip',
                'ip_camera_side' => 'required|ip|ipv4|unique:camera_ip_addresses,ip',
            ],
            [
                'gate_number.required' => 'Nomor Gate Kosong.',
                'gate_number.alpha_num' => 'Format Nomor Gate tidak sesuai.',
                'ip_camera_top.required' => 'IP Kamera Atas Kosong.',
                'ip_camera_top.ip' => 'Format IP Kamera Atas tidak sesuai.',
                'ip_camera_top.ipv4' => 'Format IP Kamera Atas tidak sesuai.',
                'ip_camera_side.required' => 'IP Kamera Samping Kosong.',
                'ip_camera_side.ip' => 'Format IP Kamera Samping tidak sesuai.',
                'ip_camera_side.ipv4' => 'Format IP Kamera Samping tidak sesuai.',
            ]
        );

        if(!$validator->fails()){
            // return $request->except('_token');

            $gateInsert = Camera_gate::create([
                'gate_number' => $request->gate_number,
            ]);

            $cameraTopInsert = Camera_ip_address::create([
                'ip' => $request->ip_camera_top,
                'camera_type' => 1,
                'camera_gate_id' => $gateInsert->id,
            ]);

            $cameraSideInsert = Camera_ip_address::create([
                'ip' => $request->ip_camera_side,
                'camera_type' => 2,
                'camera_gate_id' => $gateInsert->id,
            ]);

            if($gateInsert && $cameraTopInsert && $cameraSideInsert){
                return redirect('/dashboard/monitor/segel')->with('success', 'Berhasil Input data Kamera Monitor');
            }else{
                return redirect('/dashboard/monitor/segel')->with('error', 'Gagal Input data Kamera Monitor');
            }

        }else{
            return redirect(URL::to('/dashboard/monitor/segel'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form')->with('showModal', 'ok');
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
}
