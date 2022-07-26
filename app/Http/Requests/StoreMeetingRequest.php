<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     * $table->enum('type',['physical','makeup','guest_makeup','zoom'])->index();
            $table->dateTimeTz('date');
            $table->string('venue');
            $table->string('topic')->index();
            $table->text('host');
            $table->text('uuid');
            $table->unsignedBigInteger('meeting_no')->index();
            $table->foreignIdFor(GradingRule::class);
            $table->foreignIdFor(Club::class);
            $table->text('official_start_time');
            $table->text('official_end_time');
            $table->text('detail');
            $table->timestamps();
     */
    public function rules()
    {


        return [
                  'date'=>'required',
                  'venue'=>'required',
                  'topic'=>'required',
                  'official_start_time'=>'required',
                  'official_end_time'=>'required',
                  'grading_rule_id'=>'required'

               ];
    }
}
