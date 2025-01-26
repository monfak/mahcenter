<?php

namespace App\Http\Views\Composers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class MenuCategoriesComposer
{
    public function compose(View $view)
    {
        $menuCategories = Cache::remember('menu-categories', now()->addMinutes(5), function () {
            return Category::query()->select(['id', 'name', 'slug', 'icon', 'parent_id'])->with(['children' => function($query) {
                $query->with(['children' => function($query) {
                    $query->select(['id', 'name', 'slug', 'parent_id'])->with(['children' => function($query) {
                        $query->select(['id', 'name', 'slug', 'parent_id'])->active()->menu();
                    }])->active()->menu();
                }])->active()->menu();
            }])->whereNull('parent_id')->active()->menu()->orderBy('sort_order','ASC')->get();
        });
        $view->with('menuCategories', $menuCategories);
    }
}
