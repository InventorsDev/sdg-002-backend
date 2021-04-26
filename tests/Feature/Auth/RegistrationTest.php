<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user can register
     *
     * @return void
     * @test
     */
    public function user_can_register()
    {

        $this->withoutExceptionHandling();

        $response = $this->post("api/v1/auth/register", [
            "name" => "Jack Doe",
            "email" => "john.doe@gmail.com",
            "password" => "password"
        ]);

        $response->assertJsonStructure([
            'token'
        ]);
        
        $response->assertStatus(200);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@gmail.com',
        ]);
    }
}
