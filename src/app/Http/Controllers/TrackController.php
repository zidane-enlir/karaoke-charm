<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTrack;
use App\Http\Requests\EditTrack;
use App\Http\Requests\PlaylistTrackCreate;
use App\Models\Track;
use App\Repositories\Playlist\PlaylistRepositoryInterface;
use App\Repositories\Track\TrackRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackController extends Controller
{
    /**
     * @var \App\Repositories\Track\TrackRepositoryInterface
     */
    private $track;
    
    /**
     * @var \App\Repositories\Playlist\PlaylistRepositoryInterface
     */
    private $playlist;

    /**
     * 
     */
    public function __construct(
        PlaylistRepositoryInterface $playlist,
        TrackRepositoryInterface $track)
    {
        $this->track    = $track;
        $this->playlist = $playlist;
    }


    /**
     * 登録済の曲を一覧表示する。
     *
     * @return \Illuminate\View\View $view 
     */
    public function index()
    {
        // $this->track = Auth::user()->tracks()->get();
        $track = $this->track->getAllAuthUserTracks();

        return view('track/index')
                ->with('tracks', $track);
    }


    /**
     * 曲を新規登録する入力画面を表示する。
     * (showメソッドで、ルートモデルバインディングを用いるかどうか検討中)
     * 
     * @return \Illuminate\View\View $view
     */
    public function create()
    {
        return view('track/create');
    }


    /**
     * 新規登録の入力画面から受け取った値をDBに保存する。
     * 
     * @param \App\Http\Requests\CreateTrack $request
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function store(CreateTrack $request)
    {
        $this->track->storeUserTrack($request);

        $track = $this->track->getAllAuthUserTracks();

        return redirect()->route('tracks.index', [
            'tracks' => $track
        ]);
    }

    /**
     * その曲をどのプレイリストに所属させるかを選択する画面を表示する。
     * 
     * @param int $track
     * @return \Illuminate\View\View $view
     */
    public function show(int $track)
    {
        // ログインユーザーが作成した全てのプレイリストを取得
        $playlist = $this->playlist->getAllAuthUserPlaylists();

        // 選択された曲のみ取得
        $track = $this->track->selectUserTrack($track);


        return view('track/show')
                ->with([
                    'playlists' => $this->playlist,
                    'track'     => $this->track
                    ]);
    }

    /**
     * 既存の曲情報を変更する画面を出す。
     * 
     * @param int $track_id
     * @return \Illuminate\View\View $view
     */
    public function edit(int $track_id)
    {
        $track = $this->track->selectUserTrack($track_id);

        return view('track/edit')
                    ->with('track', $track);
    }

    /**
     * 既存の曲情報を変更する。
     * 
     * @param int $track
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function update(int $track, EditTrack $request)
    {
        $message = $this->track->updateTrackInfo($request->title, $request->artist, $track);

        $request->session()->flash(
            'message', $message
        );

        $track = $this->track->getAllAuthUserTracks();

        return redirect()->route('tracks.index')
                            ->with([
                                'tracks' => $track
                            ]);
    }

    /**
     * 既存の曲情報をDBから削除する。
     * 
     * @param int $track
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function destroy(Request $request, int $track)
    {
        $message = $this->track->deleteTrackInfo($track);

        $request->session()->flash(
            'message', $message
        );

        $track = $this->track->getAllAuthUserTracks();


        return redirect()->route('tracks.index')
                    ->with([
                        'tracks' => $track,
                        ]);
    }

    /**
     * 選択した曲を選択したプレイリストに所属させ、中間テーブルに保存する。
     * 
     * @param \App\Http\Requests\PlaylistTrackCreate $request
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function addPlaylist(PlaylistTrackCreate $request)
    {
        // 現在の選択中の曲を取得
        $this->track = $this->track->selectUserTrack($request->track_id);

        // 中間テーブル(playlist_track)にattachメソッドで保存
        $this->track->playlists()->attach(
            [ 'playlist_id' => $request->playlist_id ], 
            [ 'track_id'    => $this->track->id ]
        );

        // 登録先として指定したプレイリストを取得
        $playlist = $this->playlist->selectPlaylist($request->playlist_id);

        return redirect()->route('playlists.show', [
            'playlist' => $playlist
        ]);
    }
}
