<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png'],
            'nickname' => ['required', 'max:20'],
            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'max:255'],
            'building' => ['nullable', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'profile_image.image' => '画像ファイルを選択してください',
            'profile_image.mimes' => '画像はjpegまたはpng形式で選択してください',

            'nickname.required' => 'ユーザー名を入力してください',
            'nickname.max' => 'ユーザー名は20文字以内で入力してください',

            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.regex' => '郵便番号は「123-4567」の形式で入力してください',

            'address.required' => '住所を入力してください',
            'address.max' => '住所は255文字以内で入力してください',

            'building.max' => '建物名は255文字以内で入力してください',
        ];
    }
}
