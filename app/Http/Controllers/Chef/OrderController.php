<?php
namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderCompleted;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $pedidos = Order::where('status','cerrado')->get();
        return view('chef.pedidos.index', compact('pedidos'));
    }

    public function markReady(Order $order)
    {
        $order->update(['status'=>'listo']);
        $order->user->notify(new OrderCompleted($order));
        return back()->with('success','Pedido marcado como listo');
    }

    public function reportMissing(Order $order, Request $req)
    {
        $order->update(['status'=>'falta_ingredientes']);
        // aquí podrías guardar $req->input('mensaje')
        return back()->with('warning','Se ha reportado falta de ingredientes');
    }
}
