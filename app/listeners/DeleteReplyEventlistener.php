<?php

namespace App\listeners;

use App\Events\DeleteReplyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteReplyEventlistener
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
     * @param  DeleteReplyEvent  $event
     * @return void
     */
    public function handle(DeleteReplyEvent $event)
    {
        //
    }
}
