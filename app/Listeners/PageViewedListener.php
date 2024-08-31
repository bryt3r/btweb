<?php

namespace App\Listeners;

use App\Events\PageViewedEvent;
use App\Http\Traits\UserAgentTraits;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PageViewedListener
{
    use UserAgentTraits;
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
     * @param  \App\Events\PageViewedEvent  $event
     * @return void
     */
    public function handle(PageViewedEvent $event)
    {
        $this->getVisitLog($event->request, $event->page_identifier);
    }
}
