<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   public function authorize()
    {
        //dd('123');

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd('555');

        return [
            'name'      =>  'required',
            'f_name'    =>  'required',
            'email'     =>  'required|email|unique:users',
            'phone'     =>  'required|max:11',
            'password'  =>  'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Такой E-mail уже есть в базе'
        ];
    }
}