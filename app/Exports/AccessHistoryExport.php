<?php

namespace App\Exports;

use App\Access_history;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AccessHistoryExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        if($this->request->month){
            return view('exports.access-history-exports', [
                'access_history' => Access_history::with(['employees.departments'])
                        ->whereMonth('created_at', $this->request->month)
                        ->get()
            ]);
        }else if($this->request->dateStart && $this->request->dateEnd){
            return view('exports.access-history-exports', [
                'access_history' => Access_history::with(['employees.departments'])
                        ->whereBetween('created_at', [$this->request->dateStart, $this->request->dateEnd])
                        ->get()
            ]);
        }else{
            return view('exports.access-history-exports', [
                'access_history' => Access_history::with(['employees.departments'])->get()
            ]);
        }
    }
}
