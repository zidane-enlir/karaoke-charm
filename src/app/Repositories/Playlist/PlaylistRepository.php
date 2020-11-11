<?php

namespace App\Repositories\Playlist;

use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;

class PlaylistRepository implements PlaylistRepositoryInterface
{
    protected $playlist;

    /**
    * @param \App\Models\Playlist $playlist
    */
    public function __construct(Playlist $playlist)
    {
        $this->playlist = $playlist;
    }

    /**
     * ログインユーザーが持つ全てのプレイリストを取得する。
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllAuthUserPlaylists()
    {
        return Auth::user()->playlists()->get();
    }

    /**
     * ログインユーザーが持つプレイリストの内、
     * 特定の１つを選択する
     * 
     * @param int $playlist
     * @return \App\Models\Playlist
     */
    public function selectPlaylist (int $playlist)
    {
        return Playlist::find($playlist);
    }

    /**
     * プレイリストを新規作成し、DBに保存する。
     * 
     * @param string $name
     * @return string
     */
    public function storeNewPlaylist(string $name)
    {
        $this->playlist->name = $name;
        
        try {
            Auth::user()->playlists()->save($this->playlist);

            return 'プレイリストの追加に成功しました。';
        }
        catch (\Exception $e) {            
            return $e->getMessage();
        }
    }

    /**
     * プレイリストを１件、DBで更新する。
     * 
     * @param string $name
     * @param int $playlist
     * @return string
     */
    public function updatePlaylistName(string $name, int $playlist)
    {
        $this->playlist = Playlist::findOrFail($playlist);
        
        $this->playlist->name = $name;
        
        try {
            Auth::user()->playlists()->save($this->playlist);

            return 'プレイリスト名の変更に成功しました。';
        }
        catch (\Exception $e) {            
            return $e->getMessage();
        }
    }

    /**
     * プレイリストを１件、DBから削除する。
     * 
     * @param int $playlist
     * @return string
     */
    public function deletePlaylistName(int $playlist)
    {
        $this->playlist = Playlist::findOrFail($playlist);

        try {
            // $this->playlist->delete($this->playlist);
            $this->playlist->delete();

            return 'プレイリスト名の削除に成功しました。';
        }
        catch (\Exception $e) {            
            return $e->getMessage();
        }
    }

}