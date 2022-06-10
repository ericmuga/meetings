<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    public function meetings()
    {
        return $this->hasMany(Meeting::class,'meeting_no','meeting_no');
    }

    public function zoom_user()
    {
        return $this->belongsTo(ZoomUser::class);
    }
}
