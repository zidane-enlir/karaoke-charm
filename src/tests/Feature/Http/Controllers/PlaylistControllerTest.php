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

class PlaylistControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $authUser;
    /**
     * プレイリスト
     * 
     * @var
     */
    protected $playlist;

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
    }

    /**
     * @test
     * 
     * 未ログインユーザーがプレイリスト一覧ページにアクセス
     */
    public function GuestPlaylistIndex()
    {
        Auth::logout();
        $response = $this->get(route('playlists.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     * 
     * 登録済のプレイリストを一覧表示ページにアクセスできるか確認。
     */
    public function PlaylistIndex() 
    {
        $response = $this->get('/playlists');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('playlist.index');
        $response->assertSee('プレイリスト');
    }

    /**
     * @test
     * 
     * プレイリストを新規作成する画面を表示できるかを確認。
     */
    public function PlaylistCreate() 
    {
        $response = $this->get('/playlists/create');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('playlist.create');
        $response->assertSee('プレイリストを追加する');
    }

    /**
     * @test
     * 
     * 選択したプレイリスト(閲覧権限のある自分のプレイリスト)の詳細に
     * 含まれる曲を一覧表示できるかを確認。
     */
    public function MyPlaylistShow() 
    {
        // PlaylistPolicyのviewにあるように、
        // $user->id == $playlist->user_idを定める
        $this->playlist = factory(Playlist::class)->create([
                    'user_id' => $this->authUser->id
            ]);

        $response = $this->get(route('playlists.show', [
                                'playlist' => $this->playlist
                            ]));

        //  Expected status code 200 but received 403.
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('playlist.show');
        $response->assertSee('リストに曲を追加する');
    }

    /**
     * @test
     * 
     * 選択したプレイリスト(閲覧権限のある他人のプレイリスト)の詳細に
     * 含まれる曲を一覧表示できるかを確認。
     */
    public function SomeonesPlaylistShow() 
    {
        $response = $this->get(route('playlists.show', [
                                'playlist' => $this->playlist
                            ]));

        //  Expected status code 200 but received 403.
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $response->assertSee('自分以外のプレイリストは閲覧できません');
    }

    /**
     * @test
     * 
     * 新規作成するプレイリストをDBに保存できるかを確認。
     */
    public function PlayistStore()
    {
        //エラーが起きても例外処理をしない
        $response = $this->withoutExceptionHandling();
        $response = $this->post('/playlists', [
                        'user_id' => $this->authUser->id,
                        'name'    => 'PlaylistTest01'
                        ]);

        $response->assertRedirect(route('playlists.index'));
    }
}
