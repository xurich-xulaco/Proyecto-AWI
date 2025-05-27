<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pedido;
use App\Models\Pizza;

class OrderFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cashier_can_create_order_for_customer()
    {
        $cashier = User::factory()->create(['rol' => 'cajero']);
        $customer = User::factory()->create(['rol' => 'cliente']);
        $pizza = Pizza::factory()->create();

        $this->actingAs($cashier);
        $response = $this->post('/pedidos', [
            'user_id' => $customer->id,
            'pizza_id' => $pizza->id,
            'cantidad' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pedidos', ['user_id' => $customer->id]);
    }

    /** @test */
    public function chef_can_mark_order_as_ready()
    {
        $chef = User::factory()->create(['rol' => 'chef']);
        $pedido = Pedido::factory()->create(['estado' => 'en_proceso']);

        $this->actingAs($chef);
        $response = $this->patch("/pedidos/{$pedido->id}/completar");

        $response->assertRedirect();
        $this->assertDatabaseHas('pedidos', ['id' => $pedido->id, 'estado' => 'listo']);
    }
}
