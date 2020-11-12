<?php


use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TracksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * user_id = 1用の登録曲
         */
        $titles_1st = [
            'Tomorrow never knows', 
            'デルモ', 
            '名もなき詩'
        ];

        foreach ($titles_1st as $title_1st) {
            DB::table('tracks')->insert([
                'user_id'    => 1,
                'title'      => $title_1st,
                'artist'     => 'Mr.Children',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $titles_2nd = [
            'CHE.R.RY', 
            'Good-bye days', 
            "It's all too much"
        ];

        foreach ($titles_2nd as $title_2nd) {
            DB::table('tracks')->insert([
                'user_id'    => 1,
                'title'      => $title_2nd,
                'artist'     => 'YUI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        /**
         * user_id = 2用の登録曲
         */
        $titles_3rd = [
            '残酷な天使のテーゼ' => '高橋洋子', 
            'Butter-Fly'      => '和田光司', 
            '紅蓮華'           => 'LiSA',
        ];

        foreach ($titles_3rd as $key_03 => $value_03) {
            DB::table('tracks')->insert([
                'user_id'    => 2,
                'title'      => $key_03,
                'artist'     => $value_03,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        factory(App\Models\Track::class, 500)->create();
    }
}
