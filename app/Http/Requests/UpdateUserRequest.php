<?php

namespace App\Http\Requests;

use App\Enums\AUserType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       return (auth()->user()->type == AUserType::ADMIN || auth()->user() == $this->request->get('id'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $num = 'required|numeric';
        if (auth()->user()->type == AUserType::ADMIN)
            $num = 'nullable|numeric';
        return [
            'id' => 'required|exists:users,id',
            'name' => 'required|string',
            'email' =>  [
                'required',
                'unique:users,email,'.$this->request->get('id')
            ],
            'type' => 'required|numeric|in:1,2,3',
            'number_of_drinks' => $num,
            'phone_number' => 'nullable|numeric',
        ];
    }
}
