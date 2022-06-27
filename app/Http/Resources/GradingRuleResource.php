<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GradingRuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     $table->id();
            $table->string('name')->unique();
            $table->float('min_minutes');
            $table->integer('min_members');
            $table->time('start_time');
            // $table->enum('meeting_type',['physical','makeup','guest_makeup']);
            $table->string('meeting_type');
            $table->timestamps();*
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

                'id'=>$this->id,
                'name'=>$this->name,
                'min_members'=>$this->min_members,
                'min_minutes'=>$this->min_minutes,
                'meeting_type'=>$this->meeting_type,
                'start_time'=>Carbon::parse($this->start_time)->toTimeString(),
        ];

    }
}
