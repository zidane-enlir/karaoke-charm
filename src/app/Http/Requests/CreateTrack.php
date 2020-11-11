<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTrack extends FormRequest
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
            'title'  => 'required | max:30',
            'artist' => 'required | max:30'
        ];
    }


    /**
     * バリデーションメッセージの日本語化
     */
    public function attributes()
    {
        return [
            'title'  => '曲名',
            'artist' => 'アーティスト名'
        ];
    }

    /**
     * FormRequest クラス単位でエラーメッセージするために定義。
     * 
     * キーでメッセージが表示されるべきルールを指定する。
     * ドット区切りで左側が項目、右側がルールを意味する。
     */
    // public function messages()
    // {

    // }
}
