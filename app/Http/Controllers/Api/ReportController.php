<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * GET /api/reports/inventory
     */
    public function inventory()
    {
        // chefs y managers
        if (! Auth::user()->isRole(['chef','gerente'])) {
            abort(403);
        }

        $data = Inventory::with('ingrediente')->get()->map(function($i){
            return [
                'ingrediente' => $i->ingrediente->name,
                'cantidad'    => $i->cantidad,
            ];
        });

        return response()->json(['inventory' => $data], 200);
    }

    /**
     * GET /api/reports/sales
     * opcionalmente filtrar por rango ?from=YYYY-MM-DD&to=YYYY-MM-DD
     */
    public function sales(Request $request)
    {
        $request->validate([
            'from' => ['nullable','date'],
            'to'   => ['nullable','date','after_or_equal:from'],
        ]);

        $query = Order::query()->where('status','entregado');

        if ($request->filled('from')) {
            $query->whereDate('created_at','>=',$request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at','<=',$request->to);
        }

        $sales = $query->get()->sum('total');

        return response()->json([
            'from'  => $request->from,
            'to'    => $request->to,
            'total' => $sales,
        ], 200);
    }
}
