<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // <------------------
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'type' => 'required|numeric|in:1,2,3',
            'number_of_drinks' => 'required|numeric',
            'phone_number' => 'nullable|numeric|digits:11',
            'floor' => 'required_if:type,==,3|numeric',
        ];
    }


    public function messages()
    {
        return [
          'name.required' => 'حقل الاسم مطلوب.',
          'email.required' => 'حقل البريد الالكتروني مطلوب.',
          'email.unique' => 'البريد الإلكتروني تم أخذه سابقا.',
          'type.required' => 'حقل الوظيفه مطلوب.',
          'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالحًا.',
          'number_of_drinks.required' => 'حقل عدد المشاريب المتاحه في اليوم مطلوب.',
          'phone_number.numeric' => 'حقل رقم التليفون يجيب ان يكون ارقام.',
          'floor.required_if' => 'حقل رقم الطابق مطلوب عندما تكون وظيفه المستخدمه عامل مكتب.',
          'phone_number.digits' => 'يجب أن يتكون رقم الهاتف من 11 رقمًا.',
        ];
    }
}
