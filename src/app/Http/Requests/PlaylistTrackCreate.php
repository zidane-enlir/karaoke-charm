<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlaylistTrackCreate extends FormRequest
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
            'playlist_id' => [
                'required',
                Rule::unique('playlist_track')->ignore($this->input('id'))
                        ->where(function($query) {
                            $query->where('track_id', $this->input('track_id'));
                        }),
            ],
            'track_id'    => 'required',
        ];
    }

    /**
     * カスタムエラーメッセージを設定。
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'playlist_id.unique' 
                => '既にこのプレイリストに追加済みです。',
        ];
    }
}
