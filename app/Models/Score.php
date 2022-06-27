<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded=['id'];

    public function attendable()
    {
        return $this->morphTo();
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function badges()
    {
        return $this->hasMany(Badge::class);
    }

    public function attendableDetail($type,$id,$detail)
    {
        switch ($type)
        {

            case 'App\Models\Member': if($detail=='email') return Member::find($id)->defaultContact('email'); else  return optional(Member::findOrFail($id))->{$detail}; break;
            case 'App\Models\Guest':if ($detail=='email')return Guest::find($id)->defaultContact('email'); else return optional(Guest::findOrFail($id))->{$detail}; break;
            default:return ''; break;
        }
    }
}
