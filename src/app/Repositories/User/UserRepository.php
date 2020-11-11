<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
    * @param \App\Models\User $user
    */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * ログインユーザーを取得
     * 
     * @return \App\Models\User
     */
    public function getAuthUser()
    {
        return Auth::user();
    }

    /**
     * 名前で1レコードを取得
     *
     * @var string $name
     * @return \App\Models\User
     */
    public function getFirstRecordByName(string $name)
    {
        return $this->user->where('name', '=', $name)->first();
    }

    /**
     * ユーザーを論理削除
     * 
     * @return void
     */
    public function softDeleteUser()
    {
        Auth::user()->delete();

        return;
    }

    /**
     * ユーザープロフィールを更新
     * 
     * @param string $name
     * @return string
     * @throws \Exception
     */
    public function updateUserInfo(string $name)
    {
        $this->user = Auth::user();
        $this->user->name = $name;
        
        try {
            $this->user->save();

            return 'ユーザー情報の変更に成功しました。';
        }
        catch (\Exception $e) {            
            return $e->getMessage();
        }
    }
}