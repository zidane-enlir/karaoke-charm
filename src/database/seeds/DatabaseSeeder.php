<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PlaylistsTableSeeder::class);
        $this->call(TracksTableSeeder::class);
        $this->call(PlaylistTrackTableSeeder::class);
    }
}
