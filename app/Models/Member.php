<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Member extends Model
{
    use HasFactory;
    use \App\Traits\Personable;

    public function contacts()
    {
        return $this->morphMany(Contact::class,'contactable');
    }

    public function defaultContact($type=null)
    {
        return $this->contacts()->when($type,fn($q,$type)=>($q->where('contact_type',$type)))->first()?:'';
    }



}
