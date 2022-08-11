<?php

namespace App\Http\Resources;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        switch ($this->type ) {
            case 'Rotarian':
                $icon='rotary';
                break;
            case 'Rotaractor':
                $icon='rotaractor';
                break;

            default:
                $icon='none';
                break;
        }

        return [
            'id'=>$this->id,
         'name'=>$this->name,
        //  'member_no'=>$this->member_no,
         'member_id'=>$this->member?->id,
         'nationality'=>$this->nationality,
         'field'=>$this->field,
         'gravatar'=>Gravatar::get($this->defaultContact('email')),
         'phone'=>$this->defaultContact('phone'),
         'email'=>$this->defaultContact('email'),
         'contacts'=>$this->contacts()->get(),
         'inviter'=>$this->member?->name,
         'type'=>$this->type,
         'icon'=>$icon,
         'gender'=>$this->gender
         // 'email'=>Contact::where('contact_type','email')
         //                 ->where('contactable_type','App\Models\Member')
         //                 ->where('contactable_id',$this->id)->first()->contact
       ];
    }
}
