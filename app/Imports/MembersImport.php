<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Contact;
use PhpParser\Node\Expr\AssignOp\Concat;

class MembersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {



       Member::create([
                             'name'=>$row['name'],
                             'member_no'=>$row['member_no'],
                             'nationality'=>$row['nationality'],
                             'gender'=>$row['gender'],
                             'field'=>$row['field'],
                            ]);

         $member= Member::firstWhere('member_no',$row['member_no']);
        Contact::create([
                          'contact_type'=>'email',
                          'contact'=>$row['email'],
                          'contactable_type'=>'App\Models\Member',
                          'contactable_id'=>$member->id,
                          'default'=>true
                        ]);
                        Contact::create([
                            'contact_type'=>'phone',
                            'contact'=>$row['phone'],
                            'contactable_type'=>'App\Models\Member',
                            'contactable_id'=>$member->id,
                            'default'=>true,
                          ]);

    }
}
