<?php

// ------------+-------------------------------+-----------------------+------------------------------------------------------------------------+------------------------------------------------------+
// | Method    | URI                           | Name                  | Action                                                                 | Middleware                                           |
// +-----------+-------------------------------+-----------------------+------------------------------------------------------------------------+------------------------------------------------------+
// | GET|HEAD  | login                         | login                 | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest                                            |
// | POST      | login                         |                       | App\Http\Controllers\Auth\LoginController@login                        | web,guest                                            |
// |           |                               |                       |                                                                        |                                                      |
// | GET|HEAD  | login/{provider}              | twitter.login         | App\Http\Controllers\Auth\LoginController@redirectToProvider           | web,guest                                            |
// | GET|HEAD  | login/{provider}/callback     | twitter.callback      | App\Http\Controllers\Auth\LoginController@handleProviderCallback       | web,guest                                            |
// |           |                               |                       |                                                                        |                                                      |
// | POST      | logout                        | logout                | App\Http\Controllers\Auth\LoginController@logout                       | web                                                  |
// |           |                               |                       |                                                                        |                                                      |
// | POST      | register                      |                       | App\Http\Controllers\Auth\RegisterController@register                  | web,guest                                            |
// | GET|HEAD  | register                      | register              | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest                                            |
// |           |                               |                       |                                                                        |                                                      |
// | GET|HEAD  | password/confirm              | password.confirm      | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web,auth                                             |
// | POST      | password/confirm              |                       | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web,auth                                             |
// |           |                               |                       |                                                                        |                                                      |
// | POST      | password/email                | password.email        | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web                                                  |
// | GET|HEAD  | password/reset                | password.request      | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web                                                  |
// |           |                               |                       |                                                                        |                                                      |
// | POST      | password/reset                | password.update       | App\Http\Controllers\Auth\ResetPasswordController@reset                | web                                                  |
// | GET|HEAD  | password/reset/{token}        | password.reset        | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web                                                  |
// +-----------+-------------------------------+-----------------------+------------------------------------------------------------------------+------------------------------------------------------+
Auth::routes();
// OAuth認証先にリダイレクト
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')->name('twitter.login');
// OAuth認証の結果受け取り
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('twitter.callback');

Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function(){
    
    // Playlist
    Route::resource('playlists', 'PlaylistController');

    // +-----------+-------------------------------+-----------------------+----------------------------------------------------------+
    // | Method    | URI                           | Name                  | Action                                                   |
    // +-----------+-------------------------------+-----------------------+----------------------------------------------------------+
    // | GET|HEAD  | playlists                     | playlists.index       | App\Http\Controllers\PlaylistController@index            |
    // | GET|HEAD  | playlists/{playlist}          | playlists.show        | App\Http\Controllers\PlaylistController@show             |
    // | GET|HEAD  | playlists/create              | playlists.create      | App\Http\Controllers\PlaylistController@create           |
    // | POST      | playlists                     | playlists.store       | App\Http\Controllers\PlaylistController@store            |
    // |           |                               |                       |                                                          |
    // | GET|HEAD  | playlists/{playlist}/edit     | playlists.edit        | App\Http\Controllers\PlaylistController@edit             |
    // | PUT|PATCH | playlists/{playlist}          | playlists.update      | App\Http\Controllers\PlaylistController@update           |
    // | DELETE    | playlists/{playlist}          | playlists.destroy     | App\Http\Controllers\PlaylistController@destroy          |
    // +-----------+-------------------------------+-----------------------+----------------------------------------------------------+


    // デフォルトのリソースルート以外のルートをリソースコントローラへ追加する場合は、Route::resourceの呼び出しより前に定義する必要があります。
    Route::post('tracks/addplaylist', 'TrackController@addPlaylist')->name('tracks.add');

    // Track
    Route::resource('tracks', 'TrackController');
    // +-----------+-------------------------------+-----------------------+----------------------------------------------------------+
    // | Method    | URI                           | Name                  | Action                                                   |
    // +-----------+-------------------------------+-----------------------+----------------------------------------------------------+
    // | GET|HEAD  | tracks                        | tracks.index          | App\Http\Controllers\TrackController@index
    // | GET|HEAD  | tracks/create                 | tracks.create         | App\Http\Controllers\TrackController@create
    // | POST      | tracks                        | tracks.store          | App\Http\Controllers\TrackController@store 
    // |           |                               |                       | 
    // | GET|HEAD  | tracks/{track}                | tracks.show           | App\Http\Controllers\TrackController@show 
    // | POST      | tracks/addplaylist            | tracks.add            | App\Http\Controllers\TrackController@addPlaylist 
    // |           |                               |                       |
    // | GET|HEAD  | tracks/{track}/edit           | tracks.edit           | App\Http\Controllers\TrackController@edit 
    // | PUT|PATCH | tracks/{track}                | tracks.update         | App\Http\Controllers\TrackController@update    
    // |           |                               |                       | 
    // | DELETE    | tracks/{track}                | tracks.destroy        | App\Http\Controllers\TrackController@destroy
    // +-----------+-------------------------------+-----------------------+----------------------------------------------------------+
    
    // User
    Route::resource('users', 'UserController', ['only' => 'destroy']);

    // UserProfile
    Route::resource('users.profiles', 'UserProfileController', ['only' => ['show', 'edit', 'update']]);

    // +-----------+--------------------------------------+--------------------------+------------------------------------------------------------------------+--------------+
    // | Method    | URI                                  | Name                     | Action                                                                 | Middleware   |
    // +-----------+--------------------------------------+--------------------------+------------------------------------------------------------------------+--------------+
    // | GET|HEAD  | users/{user}/profiles/{profile}      | users.profiles.show      | App\Http\Controllers\UserProfileController@show                        | web,auth     |
    // | PUT|PATCH | users/{user}/profiles/{profile}      | users.profiles.update    | App\Http\Controllers\UserProfileController@update                      | web,auth     |
    // | GET|HEAD  | users/{user}/profiles/{profile}/edit | users.profiles.edit      | App\Http\Controllers\UserProfileController@edit                        | web,auth     |
    // +-----------+--------------------------------------+--------------------------+------------------------------------------------------------------------+--------------+
    

    // UserProfilePhoto
    Route::resource('users.profiles.photos', 'UserProfilePhotoController', ['only' => ['create', 'store']]);
    // +-----------+-----------------------------------------------+------------------------------+------------------------------------------------------------------------+--------------+
    // | Method    | URI                                           | Name                         | Action                                                                 | Middleware   |
    // +-----------+-----------------------------------------------+------------------------------+------------------------------------------------------------------------+--------------+
    // | GET|HEAD  | users/{user}/profiles/{profile}/photos/create | users.profiles.photos.create | App\Http\Controllers\UserProfilePhotoController@create                 | web,auth     |
    // | POST      | users/{user}/profiles/{profile}/photos        | users.profiles.photos.store  | App\Http\Controllers\UserProfilePhotoController@store                  | web,auth     |
    // +-----------+-----------------------------------------------+------------------------------+------------------------------------------------------------------------+--------------+
});

// 動く機能 (APIライブラリ動作テスト)
// Route::get('/spotify/search', 'SpotifyController@searchAlbum')->name('spotifies.search');

// アーティスト一覧を取得
Route::get('/spotify/search/artists', 'SpotifyController@searchArtists')->name('spotifies.allArtists');

// アーティストの曲一覧を取得
Route::get('/spotify/search/artist/tracks', 'SpotifyController@searchTracks')->name('spotifies.allTracks');

// アーティストのアルバム一覧を取得
Route::get('/spotify/search/artist/albums', 'SpotifyController@searchAlbums')->name('spotifies.allAlbums');

// [アーティストの曲一覧を取得ページにて画像をクリックして遷移]
Route::get('/spotify/search/artist/tracks/sleeve/create', 'SpotifyController@getCDSleeves')->name('spotifies.getCDSleeves');
Route::post('/spotify/search/artist/tracks/sleeve', 'SpotifyController@storeCDSleeves')->name('spotifies.storeCDSleeves');
