<?php

namespace Database\Seeders;

use App\Models\{Member,Contact,Guest};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\Meeting::factory(10)->create();
           $this->call(
                        [
                            UserTypeSeeder::class,
                            ClubSeeder::class,
                            UserSeeder::class,
                            GradingRuleSeeder::class,
                        ],

                   );
        /*Member::factory()->count(50)->create();
        Guest::factory()->count(50)->create();
         foreach (Member::all() as $member) {
             Contact::factory(['contactable_type'=>'App\Models\Member','contactable_id'=>$member->id])->count(2);
         }

         foreach (Guest::all() as $guest) {
             Contact::factory(['contactable_type'=>'App\Models\Guest','contactable_id'=>$guest->id])->count(2);
         }
*/



    }
}
