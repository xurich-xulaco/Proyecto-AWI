<?php
namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $pedidos = Order::where('status','pendiente')->get();
        return view('cajero.pedidos.index', compact('pedidos'));
    }

    public function close(Order $order)
    {
        $order->update(['status'=>'cerrado']);
        return back()->with('success','Pedido cerrado');
    }
}
