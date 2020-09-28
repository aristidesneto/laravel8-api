<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Tenant::setTenant(Tenant::find(2));
        Resident::factory()
            ->times(50)
            ->has(
                User::factory()->hasPhones()
            )
            ->create();

        \Tenant::setTenant(Tenant::find(3));
        Resident::factory()
            ->times(50)
            ->hasUser()
            ->create();
    }
}
