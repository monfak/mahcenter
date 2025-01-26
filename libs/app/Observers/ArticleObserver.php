<?php

namespace App\Observers;

use App\Events\ArticlePublished;
use App\Models\Article;

class ArticleObserver
{
    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function created(Article $article)
    {
        if($article->status == true)
        {
            event(new ArticlePublished($article));
        }
    }

    /**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        if($article->wasChanged('status'))
        {
            event(new ArticlePublished($article));
        }
    }

    /**
     * Handle the article "updating" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updating(Article $article)
    {
        //
    }

    /**
     * Handle the article "deleting" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function deleting(Article $article)
    {
        event(new ArticlePublished($article));
    }

    /**
     * Handle the article "restored" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the article "force deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}
