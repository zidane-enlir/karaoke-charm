<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_track', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('track_id')->unsigned();
            $table->bigInteger('playlist_id')->unsigned();
            $table->timestamps();

            $table->foreign('track_id')
                    ->references('id')->on('tracks')
                    ->onDelete('cascade');
            $table->foreign('playlist_id')
                    ->references('id')->on('playlists')
                    ->onDelete('cascade');

            /**
             * 中間テーブルならば、複数カラムのユニークでないと
             * 一つしか登録できないのでdb側に複数ユニークをつける
             */
            $table->unique(['playlist_id', 'track_id']); 
            
            /**
             * [重複登録防止の実装自体は成功したので、下記エラーをハンドリングする必要あり。]
             * 
             * Illuminate\Database\QueryException
             * 
             * SQLSTATE[23000]: Integrity constraint violation: 
             * 1062 Duplicate entry '2-10' for key 'playlist_track_playlist_id_track_id_unique' 
             * (SQL: insert into `playlist_track` (`created_at`, `playlist_id`, `track_id`, `updated_at`) 
             * values (2020-10-01 19:49:36, 2, 10, 2020-10-01 19:49:36))
             * 
             * http://localhost/tracks/addplaylist?playlist_id=2&track_id=10
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * [トラブル解決の参考にした]
         * https://laracasts.com/discuss/channels/laravel/i-cant-drop-unique-index
         */
        Schema::disableForeignKeyConstraints('playlist_track', function (Blueprint $table) {
            $table->dropUnique('playlist_track_playlist_id_track_id_unique');
        }); 

        Schema::dropIfExists('playlist_track');
    }
}
