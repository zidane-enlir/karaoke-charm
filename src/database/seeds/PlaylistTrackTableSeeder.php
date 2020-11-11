<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlaylistTrackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * user_id = 1 用のプレイリスト-曲の中間テーブル
         */
        $track_ids_1st   = [1, 2, 3];
        $track_ids_2nd  = [4, 5, 6];

        foreach ($track_ids_1st as $track_id_1st) {
            DB::table('playlist_track')->insert([
                'track_id' => $track_id_1st,
                'playlist_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        foreach ($track_ids_2nd as $track_id_2nd) {
            DB::table('playlist_track')->insert([
                'track_id' => $track_id_2nd,
                'playlist_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        /**
        * user_id = 2 用のプレイリスト-曲の中間テーブル
         */
        $track_ids_3rd  = [7, 8, 9];

        foreach ($track_ids_3rd as $track_id_3rd) {
            DB::table('playlist_track')->insert([
                'track_id' => $track_id_3rd,
                'playlist_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        /**
         * 
         */
        for ($i = 1 ; $i < 101 ; $i++) {
            DB::table('playlist_track')->insert([
                'track_id'    => mt_rand(10, 500),
                'playlist_id' => mt_rand(10, 500),
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
        
    }
}
