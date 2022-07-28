<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Member extends Model
{
    use HasFactory;
    use \App\Traits\Personable;

    protected $guarded=['id'];





    public function defaultContact($type=null)
    {
       return optional($this->contacts()->when($type,fn($q,$type)=>($q->where('contact_type',$type)))->first())->contact;
    }

    public function scores()
    {
        return $this->morphMany(Score::class,'attendable');
    }

    public function makeuprequests()
    {

        return $this->hasMany(MakeupRequest::class);
    }

}
