<?php

namespace App\Http\Requests;

use App\Models\Playlist;
use Illuminate\Validation\Rule;

class UpdatePlaylist extends StorePlaylist
// class UpdatePlaylist extends FormRequest
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
        // 現時点では、中身はStorePlaylistと全く同じ。(今後修正予定)
        $rule = parent::rules();

        return $rule;
        // return $rule + [
        //     'status' => 'required|' . $status_rule,
        // ];
    }
}
