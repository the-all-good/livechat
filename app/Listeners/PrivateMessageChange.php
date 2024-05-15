<?php

namespace App\Listeners;

use App\Events\PrivateMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PrivateMessageChange
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PrivateMessage $event): void
    {
        
    }
}
