<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // User用
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );
        // Playlist用
        $this->app->bind(
            \App\Repositories\Playlist\PlaylistRepositoryInterface::class,
            \App\Repositories\Playlist\PlaylistRepository::class
        );
        // Track用
        $this->app->bind(
            \App\Repositories\Track\TrackRepositoryInterface::class,
            \App\Repositories\Track\TrackRepository::class
        );
        // Spotify用
        $this->app->bind(
            \App\Repositories\Spotify\SpotifyRepositoryInterface::class,
            \App\Repositories\Spotify\SpotifyRepository::class
        );
        // UserProfile用
        $this->app->bind(
            \App\Repositories\User\UserProfileRepositoryInterface::class,
            \App\Repositories\User\UserProfileRepository::class
        );
        // TrackImage用
        $this->app->bind(
            \App\Repositories\Track\TrackImageRepositoryInterface::class,
            \App\Repositories\Track\TrackImageRepository::class
        );
    }
}
