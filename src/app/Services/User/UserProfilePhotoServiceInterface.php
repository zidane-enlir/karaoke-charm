<?php

namespace App\Services\User;

// use App\Http\Requests\CreateTrack;
// use App\Models\Playlist;
// use App\Models\Track;
// use Illuminate\Support\Facades\Auth;

interface  UserProfilePhotoServiceInterface
{
    /**
     * 画像ファイルを受け取りストレージに保存する。
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function storeImageOnStorage($file);
}