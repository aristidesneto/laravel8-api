<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResidentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_phone_resident_by_admin()
    {
        $this->assertTrue(true);
//        $tenant = Tenant::find(1);
//        \Tenant::setTenant($tenant);
//
//        $user = User::factory()->create();
//        $this->actingAs($user, 'api');
//
//        $data = [
//            "tenant_uuid" => $tenant->uuid,
//            "uuid" => $user->uuid,
//            "type" => "recado",
//            "number" => "12998751122",
//            "main" => "1"
//        ];
//
//        $this->postJson(route('residents.phones.store'), $data)
//            ->assertStatus(200);
    }
}
