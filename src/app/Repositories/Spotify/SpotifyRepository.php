<?php

namespace App\Repositories\Spotify;

use Spotify;
use Illuminate\Support\Facades\Auth;

class SpotifyRepository implements SpotifyRepositoryInterface
{
    /**
     * @var string 
     */
    private $artistIDs;

    /**
     * @var string 
     */
    private $artistID;

    /**
     * @var array
     */
    private $albumsInfo;


    /**
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * 検索欄に入力した情報にヒットしたアーティスト一覧を取得する機能
     * 
     * [工程１]
     */
    public function getAllArtistsBySearching (string $artist)
    {
        // Search artists by query.
        // $result = Spotify::searchArtists($artist)->get();
        $result = Spotify::searchArtists($artist)->country('JP')->get();

        // 取得したアーティストIDをインスタンスのプロパティに持たせる
        $this->artistID = $result['artists']['items'][0]['id'];

        return $this->artistID;
    }

    /**
     * 複数のアーティスト候補から１人選んでもらったので、曲一覧を取得する機能
     * 
     * [工程２]
     */
    public function getTargetedArtistTracks (string $artist_id)
    {
        $tracks = Spotify::artistAlbums($artist_id)->includeGroups('single')->limit(50)->get();

        return $tracks;
    }

    /**
     * artistIDを取得するメソッド
     * 
     * @param string $artist
     * @return string $this->artistID
     */
    public function getArtistIDs (string $artist = '')
    {
        // Search artists by query.
        $result = Spotify::searchArtists($artist)->get();

        // 取得したアーティストIDをインスタンスのプロパティに持たせる
        $this->artistIDs = $result['artists']['items'];

        return $this->artistIDs;
    }



    /**
     * artistIDを元に、そのアーティストのアルバムリスト取得するメソッド
     * 
     * @param string $artist_id
     * @return array $this->albumsInfo
     */
    public function getAlbumsInfo (string $artist_id)
    {
        /**
         * API Function
         * Filter the response using the provided string.
         * - param string
         * - return array
         */
        // $albums = Spotify::artistAlbums($artist_id)->includeGroups('album, single, appears_on, compilation')->get();
        $this->albumsInfo = Spotify::artistAlbums($artist_id)->includeGroups('album')->get();
        // dd($this->albumsInfo);

        // array:7 [▼
        //     "href" => "https://api.spotify.com/v1/artists/1qma7XhwZotCAucL7NHVLY/albums?offset=0&limit=20&include_groups=album"
        //     "items" => array:20 [▼
        //         0 => array:14 [▼
        //         "href" => "https://api.spotify.com/v1/albums/7ii9yznRVeFahF6heSkWOO"
        //         "id" => "7ii9yznRVeFahF6heSkWOO"
        //         "images" => array:3 [▼
        //             0 => array:3 [▶]
        //             1 => array:3 [▶]
        //             2 => array:3 [▼
        //             "height" => 64
        //             "url" => "https://i.scdn.co/image/ab67616d00004851b3461a7a2f5ca80ac8dfbe52"
        //             "width" => 64
        //             ]
        //         ]
        //         "name" => "重力と呼吸"
        //         "release_date" => "2018-10-03"
        
        return $this->albumsInfo;
    }
}