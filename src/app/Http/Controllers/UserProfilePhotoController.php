<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProfilePhoto;
use App\Models\User;
use App\Repositories\User\UserProfileRepositoryInterface;
use App\Services\User\UserProfilePhotoService;
use Illuminate\Support\Facades\Auth;

class UserProfilePhotoController extends Controller
{
    /**
     * @var int
     */
    private $user_id;

    /**
     * @var \App\Repositories\User\UserProfileRepositoryInterface
     */
    private $userProfile;
    
    /**
     * @var \App\Services\User\UserProfilePhotoService
     */
    private $userProfileService;

    public function __construct(
        UserProfileRepositoryInterface $userProfile,
        UserProfilePhotoService $userProfileService)
    {
        $this->userProfile = $userProfile;
        $this->userProfileService = $userProfileService;
    }

    /**
     * ファイルアップロード画面を表示
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user/create_profile_photo');
    }

    /**
     * ファイルアップロード処理
     * 
     * @param \App\Http\Requests\StoreUserProfilePhoto $request
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function store(StoreUserProfilePhoto $request)
    {
    
        $file = $request->profile_image;

        // ファイル本体をストレージへ保存
        $this->userProfileService->storeImageOnStorage($file);
        
        // ファイル名をDBへ保存
        $this->userProfile->storeUserProfile($file->hashName());

        return redirect()->route('users.profiles.show', [
            'user' => Auth::user()->id,
            'profile' => Auth::user()->id,
        ]);
    }
}
