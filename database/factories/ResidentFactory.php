<?php

namespace Database\Factories;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ResidentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resident::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'tenant_id' => rand(2, 3),
            'uuid' => $this->faker->uuid,
            'bloco' => strtoupper($this->faker->randomLetter) . rand(1, 99),
            'apartamento' => rand(90, 200),
            'tipo' => $this->faker->randomElement(['inquilino', 'proprietario'])
        ];
    }
}
