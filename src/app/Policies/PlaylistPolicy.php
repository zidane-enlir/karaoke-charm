<?php

namespace App\Policies;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class PlaylistPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * showメソッドに対するポリシー
     * 
     * @param \App\Models\User $user
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Playlist $playlist)
    {
        return $user->id == $playlist->user_id
                ? Response::allow()
                : Response::deny("自分以外のプレイリストは閲覧できません");
    }

    /**
     * editメソッドに対するポリシー
     * 
     * @param \App\Models\User $user
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Playlist $playlist)
    {
        return $user->id == $playlist->user_id
                ? Response::allow()
                : Response::deny("自分以外のプレイリストは編集できません");
    }
}
