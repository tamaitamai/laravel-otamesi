<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mail' => ['required'],
            'password' => ['required'],
        ];
    }

    public function attributes()
    {
        return[
            'mail' => 'メール',
            'password'=>'パスワード'
        ];
    }

    public function messages(){
        return [
            'mail.required'=>':attributeが入力されていません',
            'password.required'=>':attributeが入力されていません',
        ];
    }
}
