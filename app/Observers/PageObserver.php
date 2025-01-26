<?php

namespace App\Observers;

use App\Events\PagePublished;
use App\Models\Page;

class PageObserver
{
    /**
     * Handle the page "created" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function created(Page $page)
    {
        if($page->status == Page::STATUS_PUBLISHED)
        {
            event(new PagePublished($page));
        }
    }

    /**
     * Handle the page "updated" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function updated(Page $page)
    {
        //
    }

    /**
     * Handle the article "updating" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function updating(Page $page)
    {
        if($page->isDirty('status'))
        {
            event(new PagePublished($page));
        }
    }

    /**
     * Handle the page "deleting" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function deleting(Page $page)
    {
        event(new PagePublished($page));
    }

    /**
     * Handle the page "restored" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }

    /**
     * Handle the page "force deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }
}
