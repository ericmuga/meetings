<?php

  namespace App\Traits;

  trait Personable{

    public function user()
    {
        return $this->morphOne(User::class,'authenticatable');
    }

    public function scores()
    {
        return $this->morphMany(Score::class,'attendable');
    }

    public function contacts()
    {
        return $this->morphMany(Concat::class,'contactable');
    }
  }

?>
