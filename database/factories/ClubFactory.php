<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Club>
 */
class ClubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('area')->nullable();
            $table->timestamps();
        });
     */
    public function definition()
    {
        return [
                'name'=>$this->faker->unique()->word(),
                'description'=>$this->faker->sentence(),
                'area'=>$this->faker->word(),
                ];
    }
}
