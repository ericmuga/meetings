<?php

namespace App\Http\Resources;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Contact;

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
            'gravatar'=>Gravatar::get($this->defaultContact('email')),
            'phone'=>$this->defaultContact('phone'),
            'email'=>$this->defaultContact('email'),
            'contacts'=>$this->contacts()->get()
            // 'email'=>Contact::where('contact_type','email')
            //                 ->where('contactable_type','App\Models\Member')
            //                 ->where('contactable_id',$this->id)->first()->contact
          ];
    }
}
