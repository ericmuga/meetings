<?php

namespace App\Http\Resources;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


           return [
               'id'=>$this->id,
            'name'=>$this->name,
            'member_no'=>$this->member_no,
            'nationality'=>$this->nationality,
            'field'=>$this->field,
            'gravatar'=>($this->defaultContact('email')<>'')?Gravatar::get($this->defaultContact('email'), 'small-secure'):Gravatar::get('email@example.com'),
            'phone'=>$this->defaultContact('phone'),
            'email'=>$this->defaultContact('email'),
          ];
    }
}
