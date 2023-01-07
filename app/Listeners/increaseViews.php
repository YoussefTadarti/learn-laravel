<?php

namespace App\Listeners;

use App\Events\VideoViews;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class increaseViews
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViews $event)
    {
        $this->updateViews($event->video);
    }

    function updateViews($video){
        $video -> views = $video -> views + 1;
        $video -> save();
    }
}
