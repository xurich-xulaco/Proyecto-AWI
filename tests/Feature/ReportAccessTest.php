<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ReportAccessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_manager_and_chef_can_generate_inventory_reports()
    {
        $manager = User::factory()->create(['rol' => 'gerente']);
        $chef = User::factory()->create(['rol' => 'chef']);
        $cashier = User::factory()->create(['rol' => 'cajero']);

        $this->actingAs($manager);
        $this->get('/reportes/inventario')->assertOk();

        $this->actingAs($chef);
        $this->get('/reportes/inventario')->assertOk();

        $this->actingAs($cashier);
        $this->get('/reportes/inventario')->assertForbidden();
    }

    /** @test */
    public function only_manager_can_generate_profit_reports()
    {
        $manager = User::factory()->create(['rol' => 'gerente']);
        $chef = User::factory()->create(['rol' => 'chef']);

        $this->actingAs($manager);
        $this->get('/reportes/ganancias')->assertOk();

        $this->actingAs($chef);
        $this->get('/reportes/ganancias')->assertForbidden();
    }
}
