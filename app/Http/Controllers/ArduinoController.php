<?php

namespace App\Http\Controllers;

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
            // echo $data;
            // return ;
            if($access){
                // $data = Employee::where('uuid_card', $request->uid)->first();
                echo "<Status=1>";
                $this->getUid($request);
            }else{
                echo "<Status=0>";
                $this->getUid($request);
            }
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
}
