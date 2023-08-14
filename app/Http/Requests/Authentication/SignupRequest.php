<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'FullName'=>'required|max:255',
            'PhoneNumber'=>'required|unique:users,contact_no',
            'password'=>'required|confirmed'
        ];
    }
    public function messages(){
        return [
            'required'=>"The :attribute faild is required",
            'unique'=>"The :attribute is already used. Please try another"
        ];
    }
}
