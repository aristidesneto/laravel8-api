<?php

namespace Database\Factories;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $list = [
            '5839740108',
            '56997844574',
            '25358368729',
            '3198042030',
            '26872760766',
        ];

        return [
            'type' => $this->faker->randomElement(['celular', 'recado', 'residencial', 'trabalho']),
            'number' => $this->faker->randomElement($list),
            'main' => false
        ];
    }
}
