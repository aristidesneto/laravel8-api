<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_users()
    {
        $tenant = Tenant::find(1);
        \Tenant::setTenant($tenant);

        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $this->getJson(route('users.index'))
            ->assertStatus(200);
    }
}
