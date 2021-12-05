<?php

namespace App\Http\Controllers;

use App\Access_history;
use App\Access_user;
use App\DailyCheckUp;
use App\Exports\AccessHistoryExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AccessController extends Controller
{
    //

    public function index(){
        $access_history = Access_history::with(['employees.departments'])->paginate(10);
        // return $access_history;
        return view('admin.access-history', compact('access_history'));
    }

    public function display(){
        $total_dcu = DailyCheckUp::whereDate('created_at', Carbon::today())->count();
        $total_restrictArea = Access_user::where('status', 2)->count();
        $total_fit = DailyCheckUp::where('fit_status', 1)->whereDate('created_at', Carbon::today())->count();
        $total_unfit = DailyCheckUp::where('fit_status', 0)->whereDate('created_at', Carbon::today())->count();
        $dcu = DailyCheckUp::with(['employees'])->whereDate('created_at', Carbon::today())->get();
        $restrictArea = DB::table('access_users')
                        ->where('status', 2)
                        ->join('employees', 'access_users.uuid_card', '=', 'employees.uuid_card')
                        ->join('departments', 'employees.department_id', '=', 'departments.id')
                        ->whereDate('access_users.created_at', Carbon::today())
                        ->select('*', 'access_users.updated_at', 'access_users.status')
                        ->get();
        $fit = DailyCheckUp::with(['employees'])->where('fit_status', 1)->whereDate('created_at', Carbon::today())->get();
        $unfit = DailyCheckUp::with(['employees'])->where('fit_status', 0)->whereDate('created_at', Carbon::today())->get();
        return view('access.display', compact('total_dcu', 'total_restrictArea', 'total_fit', 'total_unfit', 'dcu', 'restrictArea', 'fit', 'unfit'));
    }

    public function access(){
        $total_dcu = DailyCheckUp::whereDate('created_at', Carbon::today())->count();
        $total_restrictArea = Access_user::where('status', 2)->count();
        $total_fit = DailyCheckUp::where('fit_status', 1)->whereDate('created_at', Carbon::today())->count();
        $total_unfit = DailyCheckUp::where('fit_status', 0)->whereDate('created_at', Carbon::today())->count();
        return view('access.access', compact('total_dcu', 'total_restrictArea', 'total_fit', 'total_unfit'));
    }

    public function masterCard(){
        $masterAccess = Access_user::where('created_at', null)->get();
        return view('admin.access-master', compact('masterAccess'));
    }

    public function addMasterCard(){
        return view('admin.add-access-master');
    }

    public function _addMasterCard(Request $request){
        $validator = Validator::make($request->all(),
        [
            'uuid_card' => 'required|max:12|alpha_num',
        ],
        [
            'uuid_card.required' => 'Nomor Kartu kosong.',
            'uuid_card.max' => 'Format Nomor Kartu tidak sesuai.',
            'uuid_card.alpha_num' => 'Format nomor kartu tidak sesuai',
        ]
        );

        if(!$validator->fails()){
            $access_master = DB::table('access_users')->insert([
                'uuid_card' => $request->uuid_card,
                'safetytalk_check' => 1,
                'dcu_check' => 1,
                'status' => 1
            ]);

            $data = DB::table('employee')->insert([
                'uuid_card' => $request->uuid_card,
                'name' => 'Kartu Master',
                'division' =>  'Kartu Master',
                'company' => 'Kartu Master',
                'employee_number' => '',
                'department_id' => 1,
            ]);

            if($access_master && $data){
                return redirect('/dashboard/master-access-card')->with('success', 'Berhasil Input data Kartu Master');
            }else{
                return redirect('/dashboard/master-access-card')->with('error', 'Gagal Input data Kartu Master');
            }

        }else{
            return redirect(URL::to('/dashboard/master-access-card/add'))->withErrors($validator)->withInput($request->all())->with('error', 'Periksa kembali form');
        }
    }


    public function removeMasterCard(Request $request){
        if($request){
            $data = Access_user::destroy($request->id);
                if($data){
                    return redirect(URL::to('/dashboard/master-access-card'))->with('success', 'Berhasil menghapus data.');
                }else{
                    return redirect(URL::to('/dashboard/master-access-card'))->with('error', 'Gagal menghapus data.');
                }
        }
    }

    public function exportAccess(Request $request){
        $month = $request->month;
        // return $request->all();
        if($request){
            return Excel::download(new AccessHistoryExport($request), 'access_history_report-'.Carbon::now()->toDateString().'.xlsx');
        }else{
            $month = Carbon::now()->month;
            return Excel::download(new AccessHistoryExport($month), 'access_history_report-'.Carbon::now()->toDateString().'.xlsx');
        }
    }


}
