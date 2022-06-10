<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')
             ->insert([
                        'name'=>'Rotary Club Langata (RCL)',
                        'description'=>'Rotary Club Langata (RCL)',
                        'area'=>'Nairobi, Langata'
                    ]);
    }
}
