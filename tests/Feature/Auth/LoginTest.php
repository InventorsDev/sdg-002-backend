<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User can login
     * @return void
     * @test
     */
    public function user_can_login()
    {
        $user = $this->createUser();

        $this->withoutExceptionHandling();
        $response = $this->post("api/v1/auth/login", [
            "email" => "john.doe@gmail.com",
            "password" => "password"
        ]);

        $this->assertAuthenticatedAs($user, $guard = 'api');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token'
        ]);
        
    }

     /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function user_can_log_out()
    {
        // $this->login();
        $user = $this->createUser();
        $token = \JWTAuth::fromUser($user);

        $this->post('api/v1/auth/logout?token=' . $token)
            ->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertGuest($guard = 'api');
    }

    private function createUser(){
        $user = User::factory()
        ->create([
            'email' => "john.doe@gmail.com"
        ]);
        return $user;
    }
}
