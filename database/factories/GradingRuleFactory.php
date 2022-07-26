<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GradingRule>
 */
class GradingRuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
        Schema::create('grading_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->float('min_minutes');
            $table->integer('min_members');
            $table->time('start_time');
            $table->enum('meeting_type',['physical','makeup','guest_makeup']);
            $table->timestamps();
        });
    }
     */
    public function definition()
    {
        return [
                'name'=>$this->faker->unique()->word(),
                'min_minutes'=>$this->faker->numberBetween(30,90),
                'min_members'=>$this->faker->numberBetween(10,90),
                'start_time'=>$this->faker->time(),
                'meeting_type'=>$this->faker->randomElement(['physical','makeup']),
                 ];
    }
}
