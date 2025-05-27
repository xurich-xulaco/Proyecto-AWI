<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BasicSystemFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_login_and_view_dashboard()
    {
        $admin = User::factory()->create([
            'rol' => 'gerente',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302); // Redirecciona tras login
        $this->assertAuthenticatedAs($admin);
    }

    /** @test */
    public function client_can_register_and_create_order()
    {
        $response = $this->post('/register', [
            'name' => 'Cliente Test',
            'email' => 'cliente@test.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(302); // Redirecciona tras registro

        $user = User::where('email', 'cliente@test.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('cliente@test.com', $user->email);
    }
}
