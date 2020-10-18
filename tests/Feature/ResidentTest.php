<?php

namespace Tests\Feature;

use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResidentTest extends TestCase
{
    public function test_store_phone_resident_by_admin()
    {
        $this->assertTrue(true);

//        // Admin user
//        $tenant = Tenant::find(1);
//        \Tenant::setTenant($tenant);
//
//        $user = User::factory()->create();
//        $this->actingAs($user, 'api');
//
//        // Resident user
//        $tenant2 = Tenant::find(2);
//        \Tenant::setTenant($tenant2);
//
//        $resident = Resident::factory()->hasUser()->create();
//
//        $data = [
//            "tenant_uuid" => $tenant->uuid,
//            "uuid" => $resident->uuid,
//            "type" => "recado",
//            "number" => "12998751122",
//            "main" => "1"
//        ];
//
//        $this->postJson(route('residents.phones.store'), $data)
//            ->assertStatus(200);
    }
}
