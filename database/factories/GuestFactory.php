<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name'=>$this->faker->name(),
            // 'member_no'=>$this->faker->numberBetween(10000,100000),
            'nationality'=>$this->faker->countryCode(),
            'field'=>$this->faker->word(),
            'gender'=>$this->faker->randomElement(['m','f'])
        ];
    }
}
