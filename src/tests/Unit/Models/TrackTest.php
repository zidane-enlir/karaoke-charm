<?php

namespace Tests\Unit\Models;

use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;


// use PHPUnit\Framework\TestCase;
use Tests\TestCase;


/**
 * [参照したテスト手法]
 * https://medium.com/@tonyfrenzy/part-2-testing-model-relationships-in-laravel-basic-8b606dd36c02
 */

class TrackTest extends TestCase
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
     * TrackインスタンスがUserインスタンスに属しているか確認
     * (１対多：逆)
     */
    public function TrackBelongsToUser()
    {
        $this->assertInstanceOf(User::class, $this->track->user);       
    }


    /**
     * @test
     * 
     * TrackインスタンスがPlaylistsインスタンスに属しているか確認
     * (多対多)
     */
    public function TrackBelongsToPlaylists()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->track->playlists); 
    }

    /** 
     * @test
     *
     * tracksテーブルには、想定したカラムが全て含まれているか確認
     */
    public function TracksTableHasExpectedColumns()
    {
        $this->assertTrue( 
          Schema::hasColumns('tracks', [
            'id',
            'user_id', 
            'title', 
            'artist', 
            'created_at',
            'updated_at'
        ]), 1);
    }

    // /**
    //  * プレイリストに登録されている曲を返すことを確認。
    //  * 
    //  * @test
    //  */
    // public function getUserTracks()
    // {
    //     // 
    // }

}
