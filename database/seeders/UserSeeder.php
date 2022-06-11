<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User,Contact,Member};
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         *

*/
       Member::forceCreate([
                           'name'=>'Eric Muga',
                           'member_no'=>'123456',
                           'nationality'=>'Kenyan',
                           'gender'=>'m',
                           'field'=>'IT'

                          ]);

        $user=User::create([

                            'name'=>'Eric Muga',
                            'email'=>'eric.muga@gmail.com',
                            'password'=>bcrypt('Microsoft2022$'),
                            'user_type_id'=>1,
                            'authenticatable_type'=>'App\Models\Member',
                            'authenticatable_id'=>1,
                            'phone'=>'0720816931'
                          ]);

       DB::table('contacts')->insert([
           'contact_type'=>'email',
           'contactable_type'=>'App\Models\User',
           'contactable_id'=>$user->id,
           'contact'=>'eric.muga@gmail.com',
           'default'=>true,
           ]);

         DB::table('contacts')->insert([
           'contact_type'=>'phone',
           'contactable_type'=>'App\Models\User',
           'contactable_id'=>$user->id,
           'contact'=>'0720816931',
           'default'=>false
           ]);




    }
}
