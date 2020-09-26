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
//        $tenant = Tenant::get()->first();

        // Tenant 1
        \Tenant::setTenant(Tenant::find(1));
        User::create([
            'uuid' => Uuid::uuid4(),
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'cpf' => '53674024020',
            'birthday' => '1987-08-28'
        ]);

        // Tenant 2
        \Tenant::setTenant(Tenant::find(2));
        User::factory()
            ->times(2)
            ->hasResident()
            ->hasPhones()
            ->create();

        // Tenant 3
        \Tenant::setTenant(Tenant::find(3));
        User::factory()
            ->times(2)
            ->hasResident()
            ->hasPhones()
            ->create();
    }
}
