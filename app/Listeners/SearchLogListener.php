<?php

namespace App\Listeners;

use App\Events\UserSearchLog;
use App\Models\SearchLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SearchLogListener
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
    public function handle(UserSearchLog $event): void
    {
        SearchLog::create([
            'user_id'      =>      auth()->user()->id,
            'log_entry'    =>       $event->log_entry
        ]);
    }
}
