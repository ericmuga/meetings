<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
* @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
*/
class ScoreFactory extends Factory
{
    /**
    * Define the model's default state.
    *
    $table->id();
    $table->foreignIdFor(Meeting::class);
    $table->morphs('attendable');
    $table->boolean('present');
    $table->float('time_score');
});
* @return array<string, mixed>
*/
public function definition()
{
    return [
        'meeting_id'=>1,//$this->factoryForModel(Meeting::class),
        'attendable_type'=>$this->faker->randomElement(['App\Models\Member']),
        'attendable_id'=>1,
        'time_score'=>$this->faker->numberBetween(1,40),
        'present'=>$this->faker->boolean()
    ];
}
}
