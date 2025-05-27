<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function inventory()
    {
        $inventory = Inventory::with('ingrediente')->get();
        return view('chef.reports.inventory', compact('inventory'));
    }
}
