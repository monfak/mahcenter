<?php

namespace App\Listeners;

use App\Events\ArticlePublished;
use App\Models\Article;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class UpdateBlogSitemap
{
    /**
     * Create the event listener.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ArticlePublished  $event
     * @return void
     */
    public function handle(ArticlePublished $event)
    {
        $articles = Article::published()->latest('updated_at')->get();
        $blogSitemap = Sitemap::create();
        foreach ($articles as $article) {
            $blogSitemap->add(Url::create(( $article->id > 147 ? '/blog/' : '/articles/page/') . $article->slug)
                ->setLastModificationDate($article->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
        }
        $blogSitemap->writeToFile(public_path('../../public_html/sitemap-blog.xml'));
    }
}
