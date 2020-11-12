<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaylist;
use App\Http\Requests\UpdatePlaylist;
use App\Jobs\PlaylistMadeNotifier;
use App\Models\Playlist;
use App\Notifications\PlaylistCreated;
use App\Repositories\Playlist\PlaylistRepositoryInterface;
use App\Repositories\Track\TrackRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PlaylistController extends Controller
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
     * @var string
     */
    private $flash_message;

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
     * 登録済のプレイリストを一覧表示する。
     * 
     * @return \Illuminate\View\View $view
     */
    public function index() 
    {
        $playlist = $this->playlist->getAllAuthUserPlaylists();        

        return view('playlist/index')
                ->with('playlists', $playlist);
    }

    /**
     * 選択したプレイリストの詳細に含まれる曲を一覧表示する。
     * 
     * @param int $playlist
     * @return \Illuminate\View\View $view
     */
    public function show(int $playlist)
    {
        // showメソッドが認可されているかどうかの確認
        $this->authorize('view', $this->playlist->selectPlaylist($playlist));

        // 選択されたプレイリストを取得。
        $selected_playlist = $this->playlist->selectPlaylist($playlist);

        // プレイリストに登録されている曲を返す。       
        $tracks = $this->track->getUserTracks($playlist);

        return view('playlist/show')
                ->with([
                    'tracks'   => $tracks, 
                    'playlist' => $selected_playlist, 
                    ]);
    }

    /**
     * プレイリストを新規作成する画面を表示する。
     * 
     * @return \Illuminate\View\View $view
     */
    public function create()
    {        
        return view('playlist/create');
    }

    /**
     * 新規作成するプレイリストをDBに保存する。
     * 
     * @param \App\Http\Requests\StorePlaylist $request
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function store(StorePlaylist $request)
    {
        $this->flash_message = $this->playlist->storeNewPlaylist($request->name);

        $request->session()->flash(
            'message', $this->flash_message
        );

        $playlists = $this->playlist->getAllAuthUserPlaylists();

        // ログインユーザー宛に、プレイリスト生成の成功を通知する 
        $authUser = Auth::user();
        PlaylistMadeNotifier::dispatch($authUser);

        return redirect()->route('playlists.index')
                ->with([
                    'playlists' => $playlists,
                    ]);
    }

    /**
     * 既存のプレイリストを変更する画面を出す。
     * 
     * @param int $playlist_id
     * @return \Illuminate\View\View $view
     */
    public function edit(int $playlist_id)
    {
        // editメソッドが認可されているかどうかの確認
        $this->authorize('update', $this->playlist->selectPlaylist($playlist_id));
                
        $playlist = $this->playlist->selectPlaylist($playlist_id);

        return view('playlist.edit')
            ->with([
                'playlist' => $playlist_id,
                'playlist_name' => $playlist->name,
                ]);
    }

    /**
     * 既存のプレイリストを変更する。
     * 
     * @param \App\Http\Requests\UpdatePlaylist $request
     * @param int $playlist
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function update(UpdatePlaylist $request, int $playlist)
    {
        // $this->authorize('update', $item);
        $this->flash_message = $this->playlist->updatePlaylistName($request->name, $playlist);

        $request->session()->flash(
            'message', $this->flash_message
        );

        $playlists = $this->playlist->getAllAuthUserPlaylists();

        return redirect()->route('playlists.index')
                    ->with([
                        'playlists' => $playlists,
                        ]);
    }

    /**
     * 既存のプレイリストをDBから削除する。
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $playlist
     * @return \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function destroy(Request $request, int $playlist)
    {
        $this->flash_message = $this->playlist->deletePlaylistName($playlist);

        $request->session()->flash(
            'message', $this->flash_message
        );

        $playlists = $this->playlist->getAllAuthUserPlaylists();


        return redirect()->route('playlists.index')
                    ->with([
                        'playlists' => $playlists,
                        ]);
    }
}
