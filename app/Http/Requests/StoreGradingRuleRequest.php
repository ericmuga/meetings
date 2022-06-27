<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradingRuleRequest extends FormRequest
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
    */
    public function rules()
    {
        return [
            'name'=>'unique:grading_rules,name|required',
            'meeting_type'=>'required',
            'min_members'=>'required|min:1',
            'min_minutes'=>'required|min:1'
        ];
    }
}
