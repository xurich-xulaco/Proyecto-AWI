<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthRolesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_login()
    {
        $manager = User::factory()->create(['rol' => 'gerente', 'password' => bcrypt('secret')]);

        $response = $this->post('/login', [
            'email' => $manager->email,
            'password' => 'secret',
        ]);

        $this->assertAuthenticatedAs($manager);
        $response->assertRedirect();
    }

    /** @test */
    public function chef_and_cashier_have_limited_access()
    {
        $chef = User::factory()->create(['rol' => 'chef']);
        $cashier = User::factory()->create(['rol' => 'cajero']);

        $this->actingAs($chef);
        $this->get('/admin/users')->assertForbidden();

        $this->actingAs($cashier);
        $this->get('/admin/users')->assertForbidden();
    }

    /** @test */
    public function customer_can_register_and_login()
    {
        $response = $this->post('/register', [
            'name' => 'Cliente Test',
            'email' => 'cliente@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['email' => 'cliente@example.com']);
    }
}
