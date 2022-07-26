<?php

  namespace App\Traits;
use App\Models\Contact;

  trait Personable
  {

    public function user()
    {
        return $this->morphOne(User::class,'authenticatable');
    }



    public function contacts()
    {
        return $this->morphMany(Contact::class,'contactable');
    }


     public function scores()
    {
        return $this->morphMany(Score::class,'attendable');
    }
  }

?>
