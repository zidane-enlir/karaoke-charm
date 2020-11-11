<?php

namespace App\Services\Spotify;

interface  SpotifyServiceInterface
{
    /**
     * 画像ファイルを受け取りストレージに保存する。
     * 
     * @param string $url
     * @return void
     */
    public function storeImageOnStorage($url);

    /**
     * 画像URLを元に、画像のMIMEタイプを識別する。
     * 
     * @param string $url
     * @return string 
     * @throws \Exception
     */
    public function getExtention(string $url);
}