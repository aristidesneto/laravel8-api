<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_successfully()
    {
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'user' => [
                    'uuid',
                    'name',
                    'email',
                    'cpf',
                    'birthday',
                    'created_at',
                    'active',
                    'isMaster',
                    'phones',
                    'tenant'
                ]
            ])->assertCookie('auth_token');

        $this->assertAuthenticated();
    }

    public function test_fail_with_invalid_email()
    {
        $data = [
            'email' => 'email@invalid.com',
            'password' => 'password'
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(422)
            ->assertJson([
                "status" => "error",
                "message" => "Credenciais inválidas"
            ]);
    }

    public function test_fail_with_invalid_password()
    {
        $data = [
            'email' => 'admin@admin.com',
            'password' => 'invalid'
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(422)
            ->assertJson([
                "status" => "error",
                "message" => "Credenciais inválidas"
            ]);
    }

    public function test_login_must_enter_email_and_password()
    {
        $data = [
            'email' => '',
            'password' => ''
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => [
                        "The email must be a valid email address.",
                        "The email field is required."
                    ],
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

//    public function test_logout()
//    {
//        $user = User::factory()->make();
//        $data = [
//            'email' => $user->email,
//            'password' => 'password'
//        ];
//
//        $this->be($user, 'api');
//        $this->assertAuthenticated();
//
//        $this->postJson(route('logout'), $data)
//            ->assertJson(['message' => 'successful logout'])
//            ->assertStatus(200);
//    }
}
