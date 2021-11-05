<?php

namespace App\Exports;

use App\DailyCheckUp;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DailyCheckUpsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View {
        if($this->request->month){
            return view('exports.dcu-exports', [
                'dcu' => DailyCheckUp::with(['employees.departments'])
                        ->whereMonth('created_at', $this->request->month)
                        ->get()
            ]);
        }else if($this->request->dateStart && $this->request->dateEnd){
            return view('exports.dcu-exports', [
                'dcu' => DailyCheckUp::with(['employees.departments'])
                        ->whereBetween('created_at', [$this->request->dateStart, $this->request->dateEnd])
                        ->get()
            ]);
        }else{
            return view('exports.dcu-exports', [
                'dcu' => DailyCheckUp::with(['employees.departments'])->get()
            ]);
        }
    }
}
