<?php

namespace Database\Factories;


use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
       Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('member_no')->unique();
            $table->string('nationality')->nullable();
            $table->enum('gender',['m','f'])->nullable();
            $table->string('field')->nullable();
            $table->timestamps();
        });

     */
    public function definition()
    {

        
        return [
            'name'=>$this->faker->name(),
            'member_no'=>$this->faker->numberBetween(10000,100000),
            'nationality'=>$this->faker->countryCode(),
            'field'=>$this->faker->word(),
            'gender'=>$this->faker->randomElement(['m','f'])
           ];

    }
}
