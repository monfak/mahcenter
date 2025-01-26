<?php

namespace App\Http\Controllers\Admin;

use App\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Http\Requests\StoreArticleCategory;
use App\Http\Requests\UpdateArticleCategory;

class ArticleCategoryController extends Controller
{
    /**
     * ArticleCategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:categories-manage');
    }
    
    public function index()
    {
        $categories=ArticleCategory::latest()->get();
        return view()->first(['admin.articleCategories.index','articleCategory::index'],compact('categories'));
    }


    public function create()
    {
        $categories=ArticleCategory::pluck('name','id');
        return view()->first(['admin.articleCategories.create','articlecategory::create'],compact('categories'));
    }


    public function store(StoreArticleCategory $request)
    {

        $category_data = [
            'name'              => $request->input('name'),
            'slug'              => $request->input('slug'),
            'parent_id'         => $request->input('category_id')==0  ? null : $request->input('category_id'),
            'description'           => $request->input('description'),
            'created_at'           => $request->input('created_at'),
        ];

        if($request->hasFile('image'))
        {
            $name = Str::random(64);
            if($request->image->storeAs('public/images/article-categories/' . date('Y/m'), $name . '.' . $request->image->extension()))
            {
                $category_data['image'] = 'storage/images/article-categories/' . date('Y/m') . '/' . $name . '.' . $request->image->extension();

                ImageManager::resize($category_data['image'], ['width' => 40, 'height' => 40]);
                ImageManager::resize($category_data['image'], ['width' => 100, 'height' => 100]);
            }
        }

        $category = new ArticleCategory($category_data);
        $category->save();
        success("دسته بندی $category->name با موفقیت افزوده شد.");
        return redirect()->route('admin.article_category.index');
    }


    public function edit($id)
    {
        $category = ArticleCategory::findOrFail($id);
        $categories = ArticleCategory::where('id', '<>', $category->id)->pluck('name','id');
        return view()->first(['admin.articleCategories.edit','articleCategory::edit'],compact('category','categories'));
    }


    public function update(UpdateArticleCategory $request, $id)
    {

        $category = ArticleCategory::findOrFail($id);

        $category_data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'parent_id'=> $request->input('category_id') == 0 ? null : $request->input('category_id'),
        ];
        if($request->hasFile('image'))
        {
            $name = Str::random(64);
            if($request->image->storeAs('public/images/article-categories/' . date('Y/m'), $name . '.' . $request->image->extension()))
            {
                $category_data['image'] = 'storage/images/article-categories/' . date('Y/m') . '/' . $name . '.' . $request->image->extension();
                ImageManager::resize($category_data['image'], ['width' => 40,'height' => 40]);
                ImageManager::resize($category_data['image'], ['width' => 100,'height' => 100]);
            }
        }
        if ($request->input('remove_image'))
        {
            $category_data['image'] = NUll;
        }

        $category->update($category_data);

        session()->flash('msg',[
            'status'=>'success',
            'title'=>'',
            'message'=>"دسته بندی $category->name با موفقیت یرایش شد."
        ]);
        return redirect()->route('admin.article_category.index');
    }

    public function destroy(Request $request,$id)
    {

        $data = $request->all();
        $category = ArticleCategory::findOrFail($id);

        if (auth()->user()->can('manage-store')) {
            $category->delete();
        }

        session()->flash('msg',[
            'status'=>'success',
            'title'=>'',
            'message'=>"دسته بندی $category->name با موفقیت حذف شد."
        ]);

        return redirect()->route('admin.article_category.index');
    }
}
