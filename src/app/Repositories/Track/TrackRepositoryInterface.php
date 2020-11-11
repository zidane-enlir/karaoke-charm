<?php

namespace App\Repositories\Track;

use App\Http\Requests\CreateTrack;

interface TrackRepositoryInterface
{

    /**
     * プレイリストに登録されている曲を返す。
     * 
     * @param int $playlist_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserTracks(int $playlist_id);

    /**
     * POSTリクエストで受け取ったパラメータを
     * Eloquent Modelのsaveメソッドを使ってDBに保存
     * 
     * @param \App\Http\Requests\CreateTrack $request
     * @return void
     */
    public function storeUserTrack(CreateTrack $request);


    /**
     * 選択された曲のみを取得
     * 
     * @param int $track
     * @return \App\Models\Track 
     */
    public function selectUserTrack(int $track);

    /**
     * ログインユーザーが持つ全ての曲を取得する。
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllAuthUserTracks();

    /**
     * ログインユーザーが持つ曲情報の１つを更新する。
     * 
    * @param string $title
     * @param string $artist
     * @param int $track
     * @return string
     */
    public function updateTrackInfo(string $title, string $artist, int $track);

    /**
     * 既存の曲情報を削除
     * 
     * @param int $track
     * @return string
     */
    public function deleteTrackInfo(int $track);
}