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

            $table->unique(['playlist_id', 'track_id']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints('playlist_track', function (Blueprint $table) {
            $table->dropUnique('playlist_track_playlist_id_track_id_unique');
        }); 

        Schema::dropIfExists('playlist_track');
    }
}
