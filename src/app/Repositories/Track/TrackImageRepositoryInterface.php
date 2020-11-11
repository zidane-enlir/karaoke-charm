<?php

namespace App\Repositories\Track;

use Illuminate\Http\Request;

interface TrackImageRepositoryInterface
{
    /**
     * プロフィール画像のURLをuser_profilesテーブルのDBレコードとして保存。
     * 
     * @param string $filename
     * @return void
     */
    public function storeTrackImage(string $filename);
}