<?php

namespace App\Http\Controllers;

use App\Access_history;
use App\Access_user;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ArduinoController extends Controller
{

    public function getAccess(Request $request){
        // return $request;

        if($request){
            // return $request->id;
            $access = Access_user::where('uuid_card', $request->uid)->first();
            $employee = Employee::where('uuid_card', $request->uid)->first();
            if($access){
                echo "<Status=".$access->status.">";

                if($request->status == 1 && $access->status == 1){
                    $update = Access_user::where('uuid_card', $request->uid)
                    ->update(['status' => 2]);
                    $history = Access_history::create([
                        'uuid_card' => $request->uid,
                        'access_status' => 2,
                        'employee_id' => $employee->id,
                    ]);
                    // return "update = ".$update."<br>"."history = ".$history;
                }else if($request->status == 2 && $access->status == 2){
                    $update = Access_user::where('uuid_card', $request->uid)
                    ->update(['status' => 1]);
                    $history = Access_history::create([
                        'uuid_card' => $request->uid,
                        'access_status' => 1,
                        'employee_id' => $employee->id,
                    ]);
                    // return "update = ".$update."<br>"."history = ".$history;
                }else{
                    // return "Failed!";
                    echo "<Status=0>";
                }

            }else{
                echo "<Status=0>";
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

    public function getUid(Request $request){
        $uid = $request->uid;
        if($uid){
            // echo $uid;
            $write = "<?php $" . "uid='" . $request->uid . "'; " . "echo $" . "uid;" . "?>";
            Storage::put('public/container/getUID.php', $write);
        }else{
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


}
