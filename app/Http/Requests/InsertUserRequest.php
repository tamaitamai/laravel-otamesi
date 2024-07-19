<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertUserRequest extends FormRequest
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
            'name' => ['required'],
            'mail' => ['required'],
            'password' => ['required'],
            'address' => ['required'],
        ];
    }

    public function attributes()
    {
        return[
            'name' => '名前',
            'mail' => 'メール',
            'password' => 'パスワード',
            'address' => '住所',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => ':attributeを入力してください',
            'mail.required' => ':attributeを入力してください',
            'password.required' => ':attributeを入力してください',
            'address.required' => ':attributeを入力してください',
        ];
    }
}
