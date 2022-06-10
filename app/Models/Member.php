<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

  public function user()
  {
      return $this->morphOne(User::class,'authenticatable');
  }

  public function scores()
  {
      return $this->morphMany(Score::class,'attendable');
  }

}
