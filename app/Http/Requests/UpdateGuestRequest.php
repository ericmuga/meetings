<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuestRequest extends FormRequest
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
            'name'=>'required',
            // 'email'=>'required|unique:contacts,contact',
            // 'phone'=>'unique:contacts,contact',
            'gender'=>'in:m,f',
            'type'=>'in:Rotarian,Rotaractor,None'

    ];
    }
}
