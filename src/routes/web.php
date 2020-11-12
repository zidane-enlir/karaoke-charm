<?php

Auth::routes();
// OAuth認証先にリダイレクト
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')->name('twitter.login');
// OAuth認証の結果受け取り
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('twitter.callback');

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    
    // Playlist
    Route::resource('playlists', 'PlaylistController');

    // デフォルトリソースルーティング以外のTrackルーティング
    Route::post('tracks/addplaylist', 'TrackController@addPlaylist')->name('tracks.add');

    // Track
    Route::resource('tracks', 'TrackController');
    
    // User
    Route::resource('users', 'UserController', ['only' => 'destroy']);

    // UserProfile
    Route::resource('users.profiles', 'UserProfileController', ['only' => ['show', 'edit', 'update']]);

    // UserProfilePhoto
    Route::resource('users.profiles.photos', 'UserProfilePhotoController', ['only' => ['create', 'store']]);
});

// アーティスト一覧を取得
Route::get('/spotify/search/artists', 'SpotifyController@searchArtists')->name('spotifies.allArtists');

// アーティストの曲一覧を取得
Route::get('/spotify/search/artist/tracks', 'SpotifyController@searchTracks')->name('spotifies.allTracks');

// アーティストのアルバム一覧を取得
Route::get('/spotify/search/artist/albums', 'SpotifyController@searchAlbums')->name('spotifies.allAlbums');

// [アーティストの曲一覧を取得ページにて画像をクリックして遷移]
Route::get('/spotify/search/artist/tracks/sleeve/create', 'SpotifyController@getCDSleeves')->name('spotifies.getCDSleeves');
Route::post('/spotify/search/artist/tracks/sleeve', 'SpotifyController@storeCDSleeves')->name('spotifies.storeCDSleeves');
