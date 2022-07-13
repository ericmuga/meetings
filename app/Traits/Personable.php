<?php

  namespace App\Traits;
use App\Models\Contact;

  trait Personable
  {

    protected $guarded =['id'];
    public function user()
    {
        return $this->morphOne(User::class,'authenticatable');
    }



    public function contacts()
    {
        return $this->morphMany(Contact::class,'contactable');
    }
  }

?>
