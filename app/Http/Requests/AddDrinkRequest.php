<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddDrinkRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'target' => 'required|numeric|in:1,2,3',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }


    public function messages()
    {
        return [
          'name.required' => 'حقل الاسم مطلوب.',
          'description.string' => 'حقل التفاصيل يجب ان يكون حروف.',
          'image_url.image' => 'يجب ان يكون الملف المرفوع صوره.',
          'image_url.mimes' => 'يجب ان تكون الصوره من النوع jpeg,png,jpg,gif,svg',
          'image_url.max' => 'اقصي حجم للصوره 2 ميجا.',
          'target.required' => 'حقل متاح الي مطلوب.',
          'target.in' => 'اختيار خاطئ في حقل متاح الي.',
        ];
    }
}
