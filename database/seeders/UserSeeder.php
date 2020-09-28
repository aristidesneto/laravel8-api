<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tenant 1
        \Tenant::setTenant(Tenant::find(1));
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'cpf' => '53674024020',
            'birthday' => '1987-08-28'
        ]);

//        // Tenant 2
//        \Tenant::setTenant(Tenant::find(2));
//        User::factory()
//            ->times(5)
//            ->hasPhones()
//            ->create();
//
//        // Tenant 3
//        \Tenant::setTenant(Tenant::find(3));
//        User::factory()
//            ->count(5)
//            ->hasPhones()
//            ->create();
    }
}
