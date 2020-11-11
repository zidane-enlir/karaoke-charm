<?php

namespace App\Services\User;

class UserProfilePhotoService implements UserProfilePhotoServiceInterface
{
    /**
     * 画像ファイルを受け取りストレージに保存する。
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function storeImageOnStorage($file)
    {
        $image = \Image::make(file_get_contents($file->getRealPath()));
        $image
            ->save(storage_path() . '/app/public/profiles/' . $file->hashName())
            ->resize(300, 300)
            ->save(storage_path() . '/app/public/profiles/300-300-'.$file->hashName())
            ->resize(500, 500)
            ->save(storage_path() . '/app/public/profiles/500-500-'.$file->hashName());
        
        return;
    }

}