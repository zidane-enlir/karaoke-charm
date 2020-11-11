#!/bin/sh


# 実行前に設定のキャッシュクリアをしないと
# 日本語化が反映されないことがあるとのこと。
# https://sazaijiten.work/laravel_factory/
php artisan config:clear


# [オプション] DBテーブルを全てDropして、マイグレーションやり直し
# php artisan migrate:fresh

# [メイン]
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed --class=PlaylistsTableSeeder
php artisan db:seed --class=TracksTableSeeder
php artisan db:seed --class=PlaylistTrackTableSeeder