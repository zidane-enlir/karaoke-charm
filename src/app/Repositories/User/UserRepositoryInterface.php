<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * ログインユーザーを取得
     * 
     * @return \App\Models\User
     */
    public function getAuthUser();

    /**
     * Nameで1レコードを取得
     *
     * @var string $name
     * @return \App\Models\User
     */
    public function getFirstRecordByName(string $name);

    /**
     * ユーザーを論理削除
     * 
     * @return void
     */
    public function softDeleteUser();

    /**
     * ユーザープロフィールを更新
     * 
     * @param string $name
     * @return string
     * @throws \Exception
     */
    public function updateUserInfo(string $name);
}