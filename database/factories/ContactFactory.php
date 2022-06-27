<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
            $table->string('contact_type');
            $table->string('contact')->unique();
            $table->morphs('contactable');
            $table->boolean('default');
            $table->timestamps();
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
                   'contact_type'=>'email',
                   'contact'=>$this->faker->safeEmail(),
                   'contactable_type'=>'App\Models\Member',
                   'contactable_id'=>$this->factoryForModel(Member::class),
                   'default'=>true


               ];
    }
}
