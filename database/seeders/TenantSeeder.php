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
                'name' => 'Master',
                'slug' => Str::kebab('master'),
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
                'name' => 'Cliente 1',
                'slug' => Str::kebab('Cliente 1'),
                'cnpj' => '18729674000197',
                'email' => 'contato@client1.com.br',
                'address' => 'Rua CC-32',
                'address_number' => '124',
                'address_district' => 'Senador Hélio Campos',
                'cep' => '69318155',
                'city' => 'Boa Vista',
                'state' => 'RR',
            ],
            [
                'name' => 'Cliente 2',
                'slug' => Str::kebab('Cliente 2'),
                'cnpj' => '30856868000159',
                'email' => 'contato@client2.com.br',
                'address' => 'Rua José Luiz da Cunha',
                'address_number' => '234',
                'address_district' => 'Quississana',
                'cep' => '83085060',
                'city' => 'São José dos Pinhais',
                'state' => 'PR',
            ],
        ];

        foreach ($list as $item) {
            Tenant::create([
                'uuid' => Uuid::uuid4(),
                'name' => $item['name'],
                'slug' => $item['slug'],
                'cnpj' => $item['cnpj'],
                'email' => $item['email'],
                'address' => $item['address'],
                'address_number' => $item['address_number'],
                'address_district' => $item['address_district'],
                'cep' => $item['cep'],
                'city' => $item['city'],
                'state' => $item['state'],
            ]);
        }
    }
}
