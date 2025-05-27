<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Notifications\OrderCreated;

class OrderController extends Controller
{
    public function create()
    {
        $productos = Product::all();
        return view('orders.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'status'  => 'pendiente',
        ]);

        foreach ($data['items'] as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
            ]);
        }

        auth()->user()->notify(new OrderCreated($order));

        return redirect()->route('pedido.create')
                         ->with('success','Pedido creado correctamente.');
    }
}
