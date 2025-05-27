<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\InventoryExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function inventory()
    {
        $format = request('format');
        if($format==='excel'){
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\InventoryExport,'inventario.xlsx');
        }
        if($format==='pdf'){
            $data = \App\Models\Product::all();
            $pdf  = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.inventory',compact('data'));
            return $pdf->download('inventario.pdf');
        }
        return view('reports.inventory');
    }

    public function profits()
    {
        $from = request('from', now()->startOfMonth()->toDateString());
        $to   = request('to',   now()->toDateString());
        $report = \App\Models\Order::whereBetween('created_at',[$from,$to])
                ->where('status','cerrado')
                ->selectRaw('DATE(created_at) as fecha, SUM(total) as total')
                ->groupBy('fecha')->get();
        return view('reports.profits',compact('report','from','to'));
    }
}
