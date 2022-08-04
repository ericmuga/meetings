<?php

use App\Models\Member;

 class MemberHelper
 {

    public static function buildSelect()
    {
        $members='';
        foreach (Member::all('id','name') as $member)
        {
            $members=$members.'<option value="'.$member->id.'">'.$member->name.'</option>';
        }

        return $members;
    }
 }

?>
