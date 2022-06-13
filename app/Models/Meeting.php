<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function scores()
    {
        return $this->HasMany(Score::class);
    }

    public function grading_rule()
    {
        return $this->belongsTo(GradingRule::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function zoom_meeting()
    {
        return $this->belongsTo(ZoomMeeting::class,'meeting_no','meeting_no')->withDefault();
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function attended($type=null)
    {
        $this->scores()->when($type,fn($q,$type)=>$q->where('attendable_type',$type))->count();
    }
}
