<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetRequestSpotify;
use App\Http\Requests\StoreCDSleeve;
use App\Repositories\Spotify\SpotifyRepositoryInterface;
use App\Repositories\Track\TrackRepositoryInterface;
use App\Repositories\Track\TrackImageRepositoryInterface;
use App\Services\Spotify\SpotifyService;
use Spotify;

class SpotifyController extends Controller
{
    /**
     * @var string $artistID
     */
    private $artistID;

    /**
     * @var \App\Repositories\Track\TrackRepositoryInterface
     */
    private $track;

    /**
     * @var array
     */
    private $album;

    /**
     * @var \App\Repositories\Spotify\SpotifyRepositoryInterface
     */
    private $spotifyRepository;

    /**
     * @var \App\Services\Spotify\SpotifyService
     */
    private $spotifyService;

    /**
     * @var \App\Repositories\Track\TrackImageRepositoryInterface
     */
    private $trackImage;

    /**
     * @var string
     */
    private $inputWord;

    /**
     * 
     */
    const IMAGEURL = 'https://i.scdn.co/image/';

    public function __construct(
            TrackRepositoryInterface $track, 
            SpotifyRepositoryInterface $spotifyRepository,
            SpotifyService $spotifyService,
            TrackImageRepositoryInterface $trackImage)
    {   
        $this->track          = $track;
        $this->spotifyRepository = $spotifyRepository;
        $this->spotifyService = $spotifyService;
        $this->trackImage     = $trackImage;
    }


    /**
     * アーティスト名を入力して、アーティスト一覧を検索結果としてを一覧表示する。
     * 
     * @param \App\Http\Requests\GetRequestSpotify $request
     * @return \Illuminate\View\View $view
     */
    public function searchArtists (GetRequestSpotify $request)
    {
        $this->inputWord = $request->word;

        // アーティストIDを取得        
        if (!is_null($this->inputWord)) {
            $this->artistID = $this->spotifyRepository->getArtistIDs($this->inputWord);  
        }

        if (is_null($this->inputWord)) {
            return view('spotify/artist')
                ->with([
                    'artist_ids' => '',
                    'input_word' => '',
                ]);
        } 
        else {
            return view('spotify/artist')
                ->with([
                    'artist_ids' => $this->artistID,
                    'input_word' => $this->inputWord,
                ]);
        }
    }

    /**
     * アーティスト名を入力して、アーティスト一覧を検索結果としてを一覧表示する。
     * 
     * @param \App\Http\Requests\GetRequestSpotify $request
     * @return \Illuminate\View\View $view
     */
    public function searchTracks (GetRequestSpotify $request)
    {
        // 選択したアーティストのartist_idを取得
        $this->artistID = $request->targeted_artist_id;
        
        // アーティストのシングル曲一覧を取得
        $this->track = $this->spotifyRepository->getTargetedArtistTracks($this->artistID);

        return view('spotify/track')
                ->with([
                    'singles' => $this->track,
                ]);
    }


    /**
     * アーティスト名を入力して、アーティスト一覧を検索結果としてを一覧表示する。
     * 
     * @param \App\Http\Requests\GetRequestSpotify $request
     * @return \Illuminate\View\View $view
     */
    public function searchAlbums (GetRequestSpotify $request)
    {
        
        // 選択したアーティストのartist_idを取得 
        $this->artistID = $request->targeted_artist_id;
        
        // アーティストのシングル曲一覧を取得
        $this->album = $this->spotifyRepository->getAlbumsInfo($this->artistID);

        return view('spotify/album')
                ->with([
                    'singles' => $this->album,
                ]);
    }

    /**
     * 選択したCDジャケット画像を取得して、画面表示する
     * 
     * @param \App\Http\Requests\GetRequestSpotify $request
     * @return \Illuminate\View\View $view
     */
    public function getCDSleeves(GetRequestSpotify $request)
    {
        $imageUrl = self::IMAGEURL . $request->imageurl;

        return view('spotify/sleeve')
                    ->with('url', $imageUrl);
    }

    /**
     * 選択したCDジャケット画像をローカルディスクに保存する。
     * 
     * @param \App\Http\Requests\StoreCDSleeve $request
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function storeCDSleeves(StoreCDSleeve $request)
    {
        $url = $request->imageurl;

        // ファイル本体をストレージへ保存
        $this->spotifyService->storeImageOnStorage($url);
        
        // ファイル名をDBへ保存
        // $this->trackImage->storeTrackImage($url);

        return redirect()->route('playlists.index');
    }
}
