<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'comment' => ['required'],
            'star' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ニックネーム',
            'comment' => 'コメント',
            'star' => '評価',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attributeを入力してください',
            'comment.required' => ':attributeを入力してください',
            'star.required' => ':attributeを入力してください',
        ];
    }
}
