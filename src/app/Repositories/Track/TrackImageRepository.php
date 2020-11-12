<?php

namespace App\Repositories\Track;

use App\Models\Track;
use App\Models\TrackImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackImageRepository implements TrackImageRepositoryInterface
{
    /**
     * @var \App\Models\TrackImage $trackImage
     */
    protected $trackImage;

    /**
     * @var \App\Models\Track $track
     */
    protected $track;

    /**
    * @param \App\Models\TrackImage $trackImage
    */
    public function __construct(TrackImage $trackImage, Track $track)
    {
        $this->trackImage = $trackImage;
        $this->track = $track;
    }


    /**
     * プロフィール画像のURLをuser_profilesテーブルのDBレコードとして保存。
     * 
     * @param string $filename
     * @return void
     */
    public function storeTrackImage(string $filename)
    {
        $this->trackImage->image_url = $filename;
        
        $this->track->trackImage()->save($this->trackImage);

        return;
    }
}