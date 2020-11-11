<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $user_repository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * ユーザーの論理削除
     * 
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function destroy()
    {
        $this->user_repository->softDeleteUser();

        return redirect()->route('login');
    }
}
