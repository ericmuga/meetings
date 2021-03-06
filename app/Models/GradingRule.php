<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingRule extends Model
{
    use HasFactory;


    protected $guarded=['id'];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }




}
