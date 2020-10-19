<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'name' => 'Administrador',
                'slug' => config('tenant.admin_tenant', 'master'),
                'cnpj' => '04039047000110',
                'email' => 'contato@master.com.br',
                'address' => 'Via Local I',
                'address_number' => '481',
                'address_district' => 'Zabelê',
                'cep' => '45078216',
                'city' => 'Vitória da Conquista',
                'state' => 'BA',
            ],
            [
                'name' => 'Residencial Altos do Santa Inês',
                'cnpj' => '18729674000197',
                'email' => 'contato@client1.com.br',
                'address' => 'Rua Albenzio Romancini',
                'address_number' => '681',
                'address_district' => 'Jardim Santa Inês III',
                'cep' => '12248255',
                'city' => 'São José dos Campos',
                'state' => 'SP',
            ],
            [
                'name' => 'Edifício Ilha Bela',
                'cnpj' => '30856868000159',
                'email' => 'contato@client2.com.br',
                'address' => 'Rua Dr. Orlando Feirabend Filho',
                'address_number' => '102',
                'address_district' => 'Jardim Aquárius',
                'cep' => '12249160',
                'city' => 'São José dos Campos',
                'state' => 'SP',
            ],
            [
                'name' => 'Edifício Ilha 222',
                'cnpj' => '30856468000159',
                'email' => 'conta3to@client2.com.br',
                'address' => 'Rua Dr. Orlando Feirabend Filho',
                'address_number' => '102',
                'address_district' => 'Jardim Aquárius',
                'cep' => '12249160',
                'city' => 'São José dos Campos',
                'state' => 'SP',
            ],
        ];

        foreach ($list as $item) {
            $tenant = Tenant::create([
                'name' => $item['name'],
                'slug' => $item['slug'] ?? '',
                'cnpj' => $item['cnpj'],
                'email' => $item['email'],
                'address' => $item['address'],
                'address_number' => $item['address_number'],
                'address_district' => $item['address_district'],
                'cep' => $item['cep'],
                'city' => $item['city'],
                'state' => $item['state'],
            ]);

            \Tenant::setTenant($tenant);

            $phones = ['celular', 'recado', 'residencial', 'trabalho'];
            $tenant->phones()->create([
                'type' => 'recado',
                'number' => '1239110578',
                'main' => false
            ]);
        }
    }
}
