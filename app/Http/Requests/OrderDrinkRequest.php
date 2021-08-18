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
            'floor_number' => 'required|numeric|min:31|max:33',
            'num_drinks' => 'required|numeric|min:1',
            'sugar_num' => 'required|numeric|min:0',
        ];
    }


    public function messages()
    {
        return [
          'drink_id.required' => 'حقل الاسم مطلوب.',
          'floor_number.required' => 'حقل الطابق مطلوب.',
          'num_drinks.required' => 'حقل العدد مطلوب.',
          'num_drinks.min' => 'حقل العدد يجب ان يكون اكبر من صفر.',
          'floor_number.min' => 'حقل الدور يجب ان يكون اكبر من صفر.',
          'floor_number.max' => 'حقل الدور يجب ان يكون 31 او 32 او 33.',
          'description.string' => 'حقل التفاصيل يجب ان يكون حروف.',
          'sugar_num.required' => 'حقل عدد معالق السكر مطلوب.',
          'sugar_num.min' => 'عدد معالق السكر يجب ان يكون اكبر من صفر.',

        ];
    }
}
