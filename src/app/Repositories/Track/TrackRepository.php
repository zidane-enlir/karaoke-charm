<?php

namespace App\Repositories\Track;

use App\Http\Requests\CreateTrack;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;

class TrackRepository implements TrackRepositoryInterface
{
    protected $track;

    /**
     * tracksテーブルのtitleカラム
     */
    protected $title;

    /**
     * @param \App\Models\Track $track
     */
    public function __construct(Track $track)
    {
        $this->track = $track;
    }

    /**
     * プレイリストに登録されている曲を返す。
     * 
     * @param int $playlist_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserTracks(int $playlist_id)
    {
        return Playlist::find($playlist_id)->tracks()->get();
    }

    /**
     * POSTリクエストで受け取ったパラメータを
     * Eloquent Modelのsaveメソッドを使ってDBに保存
     * 
     * @param \App\Http\Requests\CreateTrack $request
     * @return void
     */
    public function storeUserTrack(CreateTrack $request)
    {
        $this->track->title  = $request->title;
        $this->track->artist = $request->artist;
        
        Auth::user()->tracks()->save($this->track);

        return;
    }

    /**
     * 選択された曲のみを取得
     * 
     * @param int $track
     * @return \App\Models\Track
     */
    public function selectUserTrack(int $track)
    {
        // 選択された曲のみ取得
        $this->track = Track::find($track);

        return $this->track;
    }

    /**
     * ログインユーザーが持つ全ての曲を取得する。
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllAuthUserTracks()
    {
        return Auth::user()->tracks()->get();
    }

    /**
     * ログインユーザーが持つ曲情報の１つを更新する。
     * 
     * @param string $title
     * @param string $artist
     * @param int $track
     * @return string
     */
    public function updateTrackInfo(string $title, string $artist, int $track)
    {
        $this->track = Track::findOrFail($track);
        
        $this->track->title  = $title;
        $this->track->artist = $artist;
        
        try {
            Auth::user()->tracks()->save($this->track);

            return '曲情報の変更に成功しました。';
        }
        catch (\Exception $e) {            
            return $e->getMessage();
        }
    }

    /**
     * 既存の曲情報を削除
     * 
     * @param int $track
     * @return string
     */
    public function deleteTrackInfo(int $track)
    {
        $this->track = Track::findOrFail($track);

        try {
            $this->track->delete();

            return '曲情報の削除に成功しました。';
        }
        catch (\Exception $e) {            
            return $e->getMessage();
        }
    }
}