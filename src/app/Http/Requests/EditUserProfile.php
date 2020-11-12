<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserProfile extends FormRequest
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
        return [
            'name'  => 'required | max:30',
        ];
    }

    /**
     * バリデーションメッセージの日本語化
     * 
     * @return array
     */
    public function attributes()
    {
        return [
            'name'  => '名前',
        ];
    }
}
