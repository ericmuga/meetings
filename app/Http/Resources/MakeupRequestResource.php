<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MakeupRequestResource extends JsonResource
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
                   'makeup_date'=>$this->makeup_date,
                   'description'=>$this->description,
                   'details'=>$this->details,
                   'category'=>$this->category,
                   'member'=>$this->member->name,
                   'approver'=>$this->approver,
                   'approval_date'=>$this->approval_date,




        ];
    }
}
