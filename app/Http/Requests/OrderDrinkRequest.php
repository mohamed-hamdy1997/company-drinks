<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderDrinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(); // <------------------
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'drink_id' => 'required|exists:drinks,id',
            'description' => 'nullable|string',
            'floor_number' => 'required|numeric|min:0|max:30',
            'num_drinks' => 'required|numeric|min:1',
        ];
    }


    public function messages()
    {
        return [
          'drink_id.required' => 'حقل الاسم مطلوب.',
          'floor_number.required' => 'حقل الطابق مطلوب.',
          'floor_number.num_drinks' => 'حقل العدد مطلوب.',
          'floor_number.min' => 'حقل العدد يجب ان يكون اكبر من صفر.',
          'description.string' => 'حقل التفاصيل يجب ان يكون حروف.',
        ];
    }
}
