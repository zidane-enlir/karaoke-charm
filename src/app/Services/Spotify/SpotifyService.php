<?php

namespace App\Services\Spotify;

class SpotifyService implements SpotifyServiceInterface
{
    /**
     * 画像ファイルを受け取りストレージに保存する。
     * 
     * @param string $url
     * @return void
     */
    public function storeImageOnStorage($url)
    {
        $filename = preg_replace("!https://i.scdn.co/image/!", "", $url) . "";

        $extension = $this->getExtention($url);
        // $extension = self::EXTENTION;

        $image = \Image::make($url);
        $image
            ->save(storage_path() . '/app/public/cd_sleeves/' . $filename . '.' . $extension)
            ->resize(300, 300)
            ->save(storage_path() . '/app/public/cd_sleeves/300-300-' . $filename . '.' . $extension)
            ->resize(500, 500)
            ->save(storage_path() . '/app/public/cd_sleeves/500-500-' . $filename . '.' . $extension);

        return;
    }

    /**
     * 画像URLを元に、画像のMIMEタイプを識別する。
     * 
     * @param string $url
     * @return string 
     * @throws \Exception
     */
    public function getExtention(string $url)
    {
        $img = \Image::make($url);
        $extension = $img->mime();

        if ($extension === "image/jpeg") {
            return 'jpeg';
        }
        else if ($extension === "image/png") {
            return 'png';
        }
        else if ($extension === "image/gif") {
            return 'gif';
        }
        else {
            throw new \Exception('この拡張子はサポートされておりません。');
        }
    }

}