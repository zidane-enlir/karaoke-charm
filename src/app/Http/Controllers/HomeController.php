<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse $redirectResponse
     */
    public function index()
    {
        $user = Auth::user();
        $playlist = $user->playlists()->first();

        // まだ一つもプレイリストを作っていなければホームページをレスポンスする
        if (is_null($playlist)) {
            return view('home');
        }

        // プレイリストがあればそのプレイリスト一覧にリダイレクトする
        return redirect()->route('playlists.index', [
            'playlist' => $playlist->id,
        ]);
    }
}
