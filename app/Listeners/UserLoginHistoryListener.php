<?php

namespace App\Listeners;

use App\Events\UserLoginHistory;
use App\Models\UserLoginHistory as ModelsUserLoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLoginHistoryListener
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
    public function handle(UserLoginHistory $event): void
    {
        ModelsUserLoginHistory::create([
            'user_id'           =>          auth()->user()->id,
            'ip_address'        =>          $event->ip_address,
            'browser_address'   =>          $event->browser_address
        ]);
    }
}
