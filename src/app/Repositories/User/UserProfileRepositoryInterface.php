<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;

interface UserProfileRepositoryInterface
{
    /**
     * プロフィール画像のURLをuser_profilesテーブルのDBレコードとして保存。
     * 
     * @param string $filename
     * @return void
     */
    public function storeUserProfile(string $filename);
}