<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\ArticleCategory;
use App\Models\Article;
use App\Models\Banner;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::whereStatus(true)->latest()->paginate(20);
        $editorSuggestedArticles = Cache::remember('editorSuggestedArticles', now()->addMinutes(5), function () {
            return Article::published()->suggested()->latest()->get();
        });
        $blogHeaderBanners = Cache::remember('blog-headers', now()->addMinutes(5), function () {
            return Banner::with('items')->inPosition('blog-headers')->first();
        });
        return view('frontend.articles.index', compact('articles', 'editorSuggestedArticles', 'blogHeaderBanners'));
    }
    
    public function show(Article $article)
    {
        if(!auth()->check() OR !auth()->user()->can('articles-manage')) {
            abort_unless($article->status, 404);
        }
        abort_if($article->id <= 147, 404);
        $article->load(['faqs', 'products' => function($query) {
            $query->where('stock', '>', 0)->where('status', true);
        }, 'relates' => function($query) {
            $query->published();
        }, 'comments' => function($query) {
            $query->approved();
        }]);
        return view('frontend.articles.show', compact('article'));
    }
    
    public function old(Article $article)
    {
        if(!auth()->check() OR !auth()->user()->can('articles-manage')) {
            abort_unless($article->status, 404);
        }
        abort_if($article->id > 147, 404);
        $article->load(['faqs', 'products' => function($query) {
            $query->where('status', true);
        }, 'relates' => function($query) {
            $query->published();
        }, 'comments' => function($query) {
            $query->approved();
        }]);
        return view('frontend.articles.show', compact('article'));
    }
}
