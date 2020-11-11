<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\PlaylistCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PlaylistMadeNotifier implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * ジョブがタイムアウトになるまでの秒数
     *
     * @var int
     */
    private $timeout = 0; //0秒

    /**
     * @var \App\Models\User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /**
         * ログインユーザー宛に、プレイリスト生成の成功を通知する 
         */
        $this->user->notify(new PlaylistCreated($this->user));
    }

    /**
     * 失敗したジョブの処理
     *
     * @param \Exception $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        // 失敗の通知をユーザーへ送るなど…
    }
}
