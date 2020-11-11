<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlaylistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * user_id = 1用のプレイリスト
         * 
         * 
         * 
         */
        $user_01 = DB::table('users')->first();

        $titles_01 = [
            '歌い始め', 
            '中盤', 
            '締め'
        ];
        
        foreach ($titles_01 as $title_01) {
            DB::table('playlists')->insert([
                'user_id'    => $user_01->id,
                // 'user_id'    => $user_01['id'],
                'name'       => $title_01,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }



        /**
         * user_id = 2用のプレイリスト
         * 
         * 
         * 
         */
        // $user_02 = DB::table('users')->where('id', 2)->get();
        /**
         * get()だと配列の可能性あり。
         * first()でやってみるとどうか？
         */
        $user_02 = DB::table('users')->where('id', 2)->first();

        $titles_02 = [
            'アニソン', 
            'デュエット',
        ];
        
        foreach ($titles_02 as $title_02) {
            DB::table('playlists')->insert([
                'user_id'    => $user_02->id,
                // 'user_id'    => $user_02['id'],
                // 'user_id'    => 2,
                'name'       => $title_02,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        /**
         * Factoryを用いたシーディングも追加
         * 
         * https://sazaijiten.work/laravel_factory/
         */
        factory(App\Models\Playlist::class, 500)->create();

        // factory(App\Models\Playlist::class, 500)
        //     ->create()
        //     ->each(function(App\Models\Playlist $playlist) {
        //         $playlist->user()->associate(factory(App\Models\User::class)->create());
        //     });
    }
}
