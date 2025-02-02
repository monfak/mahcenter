<?php

namespace App\Http\Controllers\Admin;

use App\Utilities\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Product;
use App\Http\Requests\StoreArticle;
use App\Http\Requests\UpdateArticle;
use App\Models\ArticleCategory;
use App\Services\ActivityLogService;
use DB;
use Yajra\DataTables\DataTables;


class ArticleController extends Controller
{
    protected $activityLogService;
    
    /**
     * ArticleController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:articles-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $articles = Article::with('user');
        
            if(!auth()->user()->can('articles-manage')) {
                $articles->where('user_id', auth()->id());
            }
    
            return Datatables::of($articles)
                ->setTotalRecords($articles->count())
                ->addColumn('author', function ($article) {
                    return $article->user->name;
                })
                ->editColumn('created_at', function ($article) {
                    return view('admin.articles.partials.created_at', compact('article'));
                })
                ->editColumn('status', function ($article) {
                    return view('admin.articles.partials.status', compact('article'));
                })
                ->addColumn('actions', function ($article) {
                    return view('admin.articles.partials.actions', compact('article'));
                })
                ->rawColumns(['created_at', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = ArticleCategory::pluck('name','id');
        $faqs = Faq::query()->pluck('heading', 'id');
        $products = Product::query()->pluck('name', 'id');
        $articles = Article::query()->pluck('title', 'id');
        return view('admin.articles.create', compact('categories', 'faqs', 'products', 'articles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreArticle $request
     * @return Response
     */
    public function store(StoreArticle $request)
    {
        $articleData = $request->only(['title', 'slug', 'content', 'meta_title', 'meta_description', 'twitter_title', 'twitter_description', 'twitter_image', 'canonical', 'status', 'is_suggested', 'category_id']);
        $articleData['user_id'] = Auth::user()->id;
        $articleData['reading_time'] = reading_time($request->input('content'));
        $page_data['is_nofollow'] = $request->input('is_nofollow', false);
        $page_data['is_noindex'] = $request->input('is_noindex', false);
        if($request->hasFile('image')) {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension())) {
                $articleData['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $articleData['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $articleData['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }
        $article = Article::create($articleData);
        $article->faqs()->sync($request->input('faqs_id', []));
        $article->products()->sync($request->input('products_id', []));
        $article->relates()->sync($request->input('relate_id', []));
        $article->refresh();
        $log = $this->activityLogService->init('مقاله', 'created')->prepare($article)->finalize()->save();

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "مقاله $article->name ایجاد شد."
        ]);

        return redirect()->route('admin.articles.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Article $article)
    {
        return redirect()->route('admin.articles.edit', $article->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return Response
     */
    public function edit(Article $article)
    {
        $categories = ArticleCategory::pluck('name','id');
        $faqs = Faq::query()->pluck('heading', 'id');
        $products = Product::query()->pluck('name', 'id');
        $article->load('faqs', 'products', 'relates');
        $selectedFaqs = array_pluck($article->faqs->toArray(), 'id');
        $selectedProducts = array_pluck($article->products->toArray(), 'id');
        $articles = Article::query()->pluck('title', 'id');
        $relatedArticles = array_pluck($article->relates->toArray(), 'id');
        return view('admin.articles.edit', compact('article','categories', 'faqs', 'products', 'selectedFaqs', 'selectedProducts', 'articles', 'relatedArticles'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateArticle $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateArticle $request, $id)
    {
        $article = Article::findOrFail($id);
        $articleData = $request->only(['title', 'slug', 'content', 'meta_title', 'meta_description', 'twitter_title', 'twitter_description', 'twitter_image', 'canonical', 'status', 'is_suggested', 'category_id']);
        $articleData['user_id'] = Auth::user()->id;
        $articleData['reading_time'] = reading_time($request->input('content'));
        $page_data['is_nofollow'] = $request->input('is_nofollow', false);
        $page_data['is_noindex'] = $request->input('is_noindex', false);
        if($request->hasFile('image'))
        {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension()))
            {
                $articleData['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $articleData['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $articleData['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }
        $log = $this->activityLogService->init('مقاله', 'updated')->prepare($article, 'old');
        $article->update($articleData);
        $article->faqs()->sync($request->input('faqs_id', []));
        $article->products()->sync($request->input('products_id', []));
        $article->relates()->sync($request->input('relate_id', []));
        $log->prepare($article)->finalize()->save();
        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "مقاله $article->name آپدیت شد."
        ]);

        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the article
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $log = $this->activityLogService->init('مقاله', 'deleted')->prepare($article, 'old')->finalize()->save();
        $article = Article::findOrFail($id);
        $article->delete();
        success('مقاله با موفقیت حذف گردید.');
        return redirect()->route('admin.articles.index');
    }
}
