<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserProfile;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * @var int $user_id
     */
    private $user_id;
    
    /**
     * @var UserRepositoryInterface $user_repository
     */
    private $user_repository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = $this->user_repository->getAuthUser();

        return view('user/show_profile')
            ->with('authUser', $user);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = $this->user_repository->getAuthUser();

        return view('user/edit_profile')
            ->with('authUser', $user);
    }

    /**
     * @param \App\Http\Requests\EditUserProfile $request
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function update(EditUserProfile $request)
    {
        // $user = $this->user_repository->getAuthUser();
        $message = $this->user_repository->updateUserInfo($request->name);

        $request->session()->flash(
            'message', $message
        );

        // notificationによる通知を追加予定 (Queueで遅延処理)

        // フラッシュメッセージ


        $user = $this->user_repository->getAuthUser();

        return redirect()->route('users.profiles.show', [
                            'user' => $user->id,
                            'profile' => $user->id,
                        ])->with([
                            'authUser' => $user,
                        ]);
    }
}
