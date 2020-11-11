<?php

namespace App\Repositories\User;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    /**
     * @var \App\Models\UserProfile $userProfile
     */
    protected $userProfile;

    /**
    * @param \App\Models\UserProfile $userProfile
    */
    public function __construct(UserProfile $userProfile)
    {
        $this->userProfile = $userProfile;
    }


    /**
     * プロフィール画像のURLをuser_profilesテーブルのDBレコードとして保存。
     * 
     * @param string $filename
     * @return void
     */
    public function storeUserProfile(string $filename)
    {
        $this->userProfile->image_url = $filename;
        
        Auth::user()->userProfile()->save($this->userProfile);

        return;
    }
}