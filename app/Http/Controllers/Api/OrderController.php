<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        // Autenticación por Sanctum
        $this->middleware('auth:sanctum');
    }

    /**
     * GET /api/orders
     */
    public function index()
    {
        // Solo devuelve los pedidos del usuario si es cliente,
        // o todos si es staff/manager
        $user = Auth::user();
        $orders = $user->isRole('cliente')
            ? Order::where('user_id', $user->id)->get()
            : Order::all();

        return OrderResource::collection($orders);
    }

    /**
     * GET /api/orders/{order}
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return new OrderResource($order);
    }

    /**
     * POST /api/orders
     */
    public function store(Request $request)
    {
        $request->validate([
            'pizzas'    => ['required','array'],
            'pizzas.*'  => ['exists:pizzas,id'],
            'direccion' => ['required','string'],
        ]);

        $order = Order::create([
            'user_id'   => Auth::id(),
            'status'    => 'pendiente',
            'direccion' => $request->direccion,
        ]);

        // relacionar pizzas y calcular total
        $total = 0;
        foreach ($request->pizzas as $pid) {
            $pizza = \App\Models\Pizza::findOrFail($pid);
            $order->detalles()->create([
                'pizza_id'  => $pid,
                'cantidad'  => 1,
                'precio'    => $pizza->price,
            ]);
            $total += $pizza->price;
        }
        $order->update(['total' => $total]);

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * PATCH /api/orders/{order}
     * Permite a cajero/cocinero/manager actualizar estado
     */
    public function update(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $request->validate([
            'status' => ['required','in:pendiente,listo,entregado,faltantes,cerrado'],
        ]);

        $order->update(['status' => $request->status]);

        // opcional: disparar email
        $order->user->notify(new \App\Notifications\OrderStatusChanged($order));

        return new OrderResource($order);
    }
}
