<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

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

    public function members()
    {
        # code... a meeting has many scores, a score belongs to a member/guest
        return $this->hasManyDeep(
             Member::class,
            [Score::class],
            [null, 'attendable_type', 'id'],
            [null, 'attendable_type','attendable_id']
        )->withIntermediate(Score::class,['time_score','present']);
    }

    public function guests()
    {
        # code... a meeting has many scores, a score belongs to a member/guest
        return $this->hasManyDeep(
             Guest::class,
            [Score::class],
            [null, 'attendable_type', 'id'],
            [null, 'attendable_type','attendable_id']
        )->withIntermediate(Score::class,['time_score','present','meeting_id']);


    }



    // public function icon()
    // {
    //     switch ($this->type) {
    //         case 'physical': return 'physicalmeeting';
    //         case 'zoom': return'zoom';
    //         case 'makeup': return 'makeup';
    //         case 'guest_makeup': return 'makeup';
    //         default:return '';
    //     }

    // }

}
