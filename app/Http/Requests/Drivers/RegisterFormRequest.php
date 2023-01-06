<?php

namespace App\Http\Requests\Drivers;

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
            'name'      =>  'required|max:255',
            'f_name'    =>  'required|max:255',
            'email'     =>  'required|email|unique:users',
            'phone'     =>  'required|digits:11',
            'password'  =>  'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'email.unique'  => 'Такой E-mail уже есть в базе',
            'phone.digits'    => 'Телефон должен быть из 11 цифр'
        ];
    }
}