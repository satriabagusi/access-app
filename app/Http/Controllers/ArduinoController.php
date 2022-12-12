<?php

namespace App\Http\Controllers;

use App\Access_history;
use App\Access_user;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ArduinoController extends Controller
{

    public function getAccess(Request $request)
    {
        // return $request;

        if ($request) {
            // return $request->id;
            $access = Access_user::where('uuid_card', $request->uid)->first();
            $employee = Employee::where('uuid_card', $request->uid)->first();
            if ($access) {
                if ($request->status == 1 && $access->status == 1) {
                    $update = Access_user::where('uuid_card', $request->uid)
                        ->update(['status' => 2]);
                    if ($employee) {
                        $history = Access_history::create([
                            'uuid_card' => $request->uid,
                            'access_status' => 2,
                            'employee_id' => $employee->id,
                        ]);
                    }
                    $this->getUid($request);
                    // echo "<Status=1>";
                    return response()->json(['code' => 200, 'status' => 1]);
                    // return "update = ".$update."<br>"."history = ".$history;
                } else if ($request->status == 2 && $access->status == 2) {
                    $update = Access_user::where('uuid_card', $request->uid)
                        ->update(['status' => 1]);
                    if ($employee) {
                        $history = Access_history::create([
                            'uuid_card' => $request->uid,
                            'access_status' => 1,
                            'employee_id' => $employee->id,
                        ]);
                    }
                    $this->getUid($request);
                    // echo "<Status=2>";
                    return response()->json(['code' => 200, 'status' => 2]);
                    // return "update = ".$update."<br>"."history = ".$history;
                } else {
                    // return "Failed!";
                    $this->getUid($request);
                    // echo "<Status=0>";
                    return response()->json(['code' => 200, 'status' => 0]);
                }
            } else {
                $this->getUid($request);
                // echo "<Status=0>";
                return response()->json(['code' => 200, 'status' => 0]);
            }
            // if($access){
            //     // $data = Employee::where('uuid_card', $request->uid)->first();
            //     echo "<Status=1>";
            //     $this->getUid($request);
            // }else{
            //     echo "<Status=0>";
            //     $this->getUid($request);
            // }
        }
    }

    public function getUid(Request $request)
    {
        $uid = $request->uid;
        if ($uid) {
            // echo $uid;
            $write = "<?php $" . "uid='" . $request->uid . "'; " . "echo $" . "uid;" . "?>";
            Storage::put('public/container/getUID.php', $write);
        } else {
            return Response::json(['status' => 404, 'message' => 'Invalid Parameter']);
        }
    }

    //   public function storeAccessHistory(array $request){
    //         return $request;
    //         if($request){
    //             $access = Access_user::where('uuid_card', $request->uid)->first();
    //             $employee = Employee::where('uuid_card', $request->uid)->first();
    //             if($access){
    //                 if($request->status == 1 && $access->status == 1){
    //                     $update = Access_user::where('uuid_card', $request->uid)
    //                     ->update(['status' => 2]);
    //                     $history = Access_history::create([
    //                         'uuid_card' => $request->uid,
    //                         'access_status' => 2,
    //                         'employee_id' => $employee->id,
    //                     ]);
    //                     return "update = ".$update."<br>"."history = ".$history;
    //                 }else if($request->status == 2 && $access->status == 2){
    //                     $update = Access_user::where('uuid_card', $request->uid)
    //                     ->update(['status' => 1]);
    //                     $history = Access_history::create([
    //                         'uuid_card' => $request->uid,
    //                         'access_status' => 1,
    //                         'employee_id' => $employee->id,
    //                     ]);
    //                     return "update = ".$update."<br>"."history = ".$history;
    //                 }else{
    //                     return "Failed!";
    //                 }
    //             }else{
    //                 return "Access not Granted!";
    //             }
    //         }
    //     }

    public function safetyTalkCheck(Request $request)
    {
        if ($request->uuid) {
            $uuid = $request->uuid;
            $access = Access_user::where('uuid_card', $request->uuid)->first();
            if (!$access) {
                DB::beginTransaction();
                try {
                    Access_user::create([
                        'uuid_card' => $uuid,
                        'safetytalk_check' => 1,
                        'status' => 0
                    ]);
                    DB::commit();
                    // return "Berhasil melakukan SafetyTalk Check";
                    return response()->json(['status' => 200, 'message' => "Berhasil melakukan SafetyTalk Check"]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    // return "Gagal melakukan SafetyTalk Check. Ulangi kembali.";
                    return response()->json(['status' => 400, 'message' => "Gagal melakukan SafetyTalk Check. Ulangi kembali."]);
                }
            } else if ($access && $access->safetytalk_check == 0) {
                if ($access->dcu_check == 1) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                DB::beginTransaction();
                try {
                    Access_user::where('uuid_card', $uuid)
                        ->update([
                            'safetytalk_check' => 1,
                            'status' => $status,
                        ]);
                    DB::commit();
                    // return "Berhasil melakukan Safetytalk Check";
                    return response()->json(['status' => 200, 'message' => "Berhasil melakukan SafetyTalk Check"]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    // return "Gagal melakukan Safetytalk Check. Ulangi kembali.";
                    return response()->json(['status' => 400, 'message' => "Gagal melakukan SafetyTalk Check. Ulangi kembali."]);
                }
            } else if ($access && $access->safetytalk_check == 1) {
                // return "Sudah melakukan Safetytalk Check.";
                return response()->json(['status' => 200, 'message' => "Sudah melakukan Safetytalk Check"]);
            }
        }
    }
}
