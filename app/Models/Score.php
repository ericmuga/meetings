<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    public function attendable()
    {
        return $this->morphTo();
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

}
