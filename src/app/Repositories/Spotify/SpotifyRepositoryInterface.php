<?php

namespace App\Repositories\Spotify;

interface SpotifyRepositoryInterface
{
    /**
     * 検索欄に入力した情報にヒットしたアーティスト一覧を取得する機能
     * 
     * [工程１]
     */
    public function getAllArtistsBySearching (string $artist);

    /**
     * 複数のアーティスト候補から１人選んでもらったので、曲一覧を取得する機能
     * 
     * [工程２]
     */
    public function getTargetedArtistTracks (string $artist_id);



    /**
     * artistIDを取得するメソッド
     * 
     * @param string $artist
     * @return string $this->artistID
     */
    public function getArtistIDs (string $artist);

    /**
     * artistIDを元に、そのアーティストのアルバムリスト取得するメソッド
     * 
     * @param string $artist_id
     * @return array
     */
    public function getAlbumsInfo (string $artist_id);
}