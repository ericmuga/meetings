<?php

namespace App\Http\Resources;
use Illuminate\Support\Str;

use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
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
                // 'type'=>$this->attendable_type,
                // 'name'=>$this->attendableDetail($this->attendable_type,$this->attendable_id,'name'),
                'id'=>$this->attendable_id,
                // 'member_no'=>($this->attendable_type=='App\Models\Member')?$this->attendableDetail($this->attendable_type,$this->attendable_id,'member_no'):'',
                // 'slug'=>Str::slug($this->attendable_type.$this->attendable_id.$this->id,'-'),
                // 'email'=>$this->attendableDetail($this->attendable_type,$this->attendable_id,'email'),
                // 'time_score'=>$this->time_score,
                // 'present'=>$this->present
               ];
    }
}
