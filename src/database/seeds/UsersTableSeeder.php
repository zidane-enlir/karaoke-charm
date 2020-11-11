<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'       => 'noel',
            'email'      => 'noel@dummy.com',
            'password'   => bcrypt('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name'       => 'カラオケ館',
            'email'      => 'karaokekan@dam.com',
            'password'   => bcrypt('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        /**
         * Factoryを用いたシーディングも追加
         * 
         * https://sazaijiten.work/laravel_factory/
         */
        factory(App\Models\User::class, 100)
            ->create(['password' => bcrypt('12345678')]);
    }
}
