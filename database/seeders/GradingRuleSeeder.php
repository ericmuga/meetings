<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class GradingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('grading_rules')
          ->insert(['name'=>'zoom',
                    'min_minutes'=>30,
                    'min_members'=>30,
                    'start_time'=>Carbon::parse('19:00'),
                    'meeting_type'=>'zoom'
                  ]);

    }



}
