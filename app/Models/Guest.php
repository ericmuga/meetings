<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Guest extends Model
{
    use HasFactory;
    use \App\Traits\Personable;


    public function scores()
    {
        return $this->morphMany(Score::class,'attendable');
    }

    public function defaultContact($type=null)
    {
       return optional($this->contacts()->when($type,fn($q,$type)=>($q->where('contact_type',$type)))->first())->contact;
    }


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    protected $guarded =['id'];
}
