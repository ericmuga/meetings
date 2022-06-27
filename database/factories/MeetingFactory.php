<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\GradingRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *  Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['physical','makeup','guest_makeup'])->index();
            $table->dateTimeTz('date');
            $table->string('venue');
            $table->string('topic')->index();
            $table->text('host');
            $table->text('uuid');
            $table->unsignedBigInteger('meeting_no')->index();
            $table->foreignIdFor(GradingRule::class);
            $table->foreignIdFor(Club::class);
            $table->text('official_start_time');
            $table->text('official_end_time');
            $table->text('detail');
            $table->timestamps();
        });
     */
    public function definition()
    {
        return [
                 'type'=>$this->faker->randomElement(['physical','makeup','guest_makeup','zoom']),
                 'date'=>$this->faker->dateTimeBetween('-1 years','now','Africa/Nairobi'),
                 'venue'=>$this->faker->word(),
                 'topic'=>$this->faker->word(),
                 'host'=>$this->faker->word(),
                 'uuid'=>$this->faker->uuid(),
                 'club_id'=>Club::factory(),
                 'meeting_no'=>$this->faker->numberBetween(100000000,10000000000),
                 'grading_rule_id'=>1,
                 'official_start_time'=>$this->faker->dateTimeBetween('-1 years','now','Africa/Nairobi'),
                 'official_end_time'=>$this->faker->dateTimeBetween('-1 years','now','Africa/Nairobi'),
                 'detail'=>$this->faker->sentence()


               ];
    }
}
