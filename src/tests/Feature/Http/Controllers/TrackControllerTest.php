<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;


class TrackControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログイン済のユーザー
     * 
     * @var
     */
    protected $authUser;

    /**
     * プレイリスト
     * 
     * @var
     */
    protected $playlist;

    /**
     * 登録曲
     * 
     * @var
     */
    protected $track;

    /**
     * フィクスチャ
     * DRYに則った設計を意識し、共通のインスタンスなどをプロパティに格納しておく。
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->authUser = factory(User::class)->create();
        $this->actingAs($this->authUser);

        $this->playlist = factory(Playlist::class)->create();
        $this->track    = factory(Track::class)->create();
    }

    /**
     * @test
     * 
     * 未ログインユーザーが曲一覧ページにアクセス
     */
    public function GuestPlaylistIndex()
    {
        Auth::logout();
        $response = $this->get(route('tracks.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     * 
     * 登録済の曲を一覧表示することができるか確認。
     */
    public function TrackIndex() 
    {
        $response = $this->get('/tracks');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('track.index');
        $response->assertSee('登録曲リスト');
    }
}
