<?php

namespace App\Http\Requests;

use App\Enums\AUserType;
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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $floor = 'nullable|numeric|in:31,32,33';
        if ($this->get('type') == AUserType::OFFICE_BOY)
            $floor = 'required|numeric|in:31,32,33';
        return [
            'name' => 'required|string',
            'password' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'type' => 'required|numeric|in:1,2,3',
            'number_of_drinks' => 'required|numeric',
            'phone_number' => 'nullable|numeric|digits:11',
            'floor' => $floor,
        ];
    }


    public function messages()
    {
        return [
          'name.required' => 'حقل الاسم مطلوب.',
          'password.required' => 'حقل الرقم السري مطلوب.',
          'password.min' => 'يجب ان يتكون الرقم السري من 5 خانات علي الاقل.',
          'email.required' => 'حقل البريد الالكتروني مطلوب.',
          'email.unique' => 'البريد الإلكتروني تم أخذه سابقا.',
          'type.required' => 'حقل الوظيفه مطلوب.',
          'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالحًا.',
          'number_of_drinks.required' => 'حقل عدد المشاريب المتاحه في اليوم مطلوب.',
          'phone_number.numeric' => 'حقل رقم التليفون يجيب ان يكون ارقام.',
          'floor.in' => 'حقل الدور يجب ان يكون 31 او 32 او 33.',
          'phone_number.digits' => 'يجب أن يتكون رقم الهاتف من 11 رقمًا.',
          'floor.required' => 'حقل رقم الطابق مطلوب عندما تكون وظيفه المستخدمه عامل مكتب.',
        ];
    }
}
