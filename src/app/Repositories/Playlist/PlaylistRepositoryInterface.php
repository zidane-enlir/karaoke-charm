<?php

namespace App\Repositories\Playlist;

interface PlaylistRepositoryInterface
{
    /**
     * ログインユーザーが持つ全てのプレイリストを取得する。
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllAuthUserPlaylists();


    /**
     * ログインユーザーが持つプレイリストの内、
     * 特定の１つを選択する
     * 
     * @param int $playlist
     * @return \App\Models\Playlist
     */
    public function selectPlaylist (int $playlist);


    /**
     * プレイリストを新規作成し、DBに保存する。
     * 
     * @return void
     */
    public function storeNewPlaylist(string $name);

    /**
     * プレイリストを１件、DBで更新する。
     * 
     * @param string $name
     * @param int $playlist
     * @return string
     */
    public function updatePlaylistName(string $name, int $playlist);

    /**
     * プレイリストを１件、DBから削除する。
     * 
     * @return void
     */
    public function deletePlaylistName(int $playlist);
}