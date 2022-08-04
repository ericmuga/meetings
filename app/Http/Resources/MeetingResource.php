<?php

namespace App\Http\Resources;

use App\Models\Score;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     *
     * Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['physical','makeup','guest_makeup'])->index();
            $table->dateTimeTz('date');
            $table->string('venue');
            $table->string('topic')->index();
            $table->text('host');
            $table->text('uuid');
            $table->unsignedBigInteger('meeting_no')->index();
            $table->text('grading_rule');
            $table->foreignIdFor(Club::class);
            $table->text('official_start_time');
            $table->text('official_end_time');
            $table->text('detail');

            $table->timestamps();
        });
     */
    public function toArray($request)
    {
        switch ($this->type) {
            case 'physical':$icon='physicalmeeting'; break;
            case 'zoom':$icon='zoom'; break;
            case 'makeup':$icon='makeup'; break;
            case 'guest_makeup':$icon='makeup'; break;

            default:
                # code...
                break;
        }

        return [
                  'id'=>$this->id,
                  'type'=>$this->type,
                  'date'=>Carbon::parse($this->date)->toDateString(),
                  'venue'=>$this->venue,
                  'topic'=>$this->topic,
                  'host'=>$this->host,
                  'meeting_no'=>$this->meeting_no,
                  'grading_rule'=>$this->grading_rule,
                  'club'=>$this->club()->first()->name,
                  'official_start_time'=>Carbon::parse($this->official_start_time)->toDateTimeString(),
                  'official_start_end'=>$this->official_start_end,
                  'guests_count'=>Score::where('attendable_type','App\Models\Guest')->where('meeting_id',$this->id)->count(),
                  'members_count'=>Score::where('attendable_type','App\Models\Member')->where('meeting_id',$this->id)->count(),
                  'attended'=>$this->scores()->where('scores.present',true)->count(),

                  'icon'=>$icon,




        ];
    }
}
