<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Model;
use DB;

#[ObservedBy([CategoryObserver::class])]
class Category extends Model
{
    protected $fillable = [
        'name',
        'label',
        'slug',
        'icon',
        'image',
        'content',
        'meta_keywords',
        'meta_description',
        'parent_id',
        'has_slider',
        'sort_order',
        'discount',
        'status',
        'show',
        'title',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'show_in_menu',
        'size_type',
    ];
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_nofollow' => 'boolean',
            'is_noindex' => 'boolean',
            'size_type' => 'integer',
        ];
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->oldest('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function activeChildren()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1)->oldest('sort_order');
    }

    public function activeParent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->where('status', 1);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function getAllSubCategoryIds()
    {
        $ids = $this->children->pluck('id')->toArray();
        foreach($this->children as $child) {
            $ids = array_merge($ids, $child->getAllSubCategoryIds());
        }
        return $ids;
    }

    public function filterGroups()
    {
        return $this->belongsToMany(FilterGroup::class);
    }
    
    public function attributeGroups()
    {
        return $this->belongsToMany(AttributeGroups::class, 'attribute_group_category', 'category_id', 'attribute_group_id');
    }

    public function filtersWithGroup()
    {
        return $this->filterGroups()->with('filters');
    }

    public function filtersWithOutBrandGroup()
    {
        return $this->filterGroups()->where('name','<>','برند')->with('filters');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->where('status',true);
    }

    public function filteredProducts(array $filters, $limit = 24, $order = 'created_at', $sort = 'ASC', $minPrice = null, $maxPrice = null, $manufacturers = [],$stock=0)
    {
        $query = $this->products()
            ->with('attributes')
            ->when(!empty($filters), function($query) use ($filters)
            {
                foreach ($filters as $filter)
                {
                    $query->whereHas('filters', function($query) use ($filter)
                    {
                        $query->whereIn('filter_id', $filter);
                    });
                }
            })
            ->where('status', 1);
            if (!is_null($minPrice)) {
                $query->where('price', '>=', $minPrice);
            }
            if (!is_null($maxPrice)) {
                $query->where('price', '<=', $maxPrice);
            }

        if($manufacturers) {
            $query->whereIn('manufacturer_id', $manufacturers);
        }

        if ($stock == 1) {
            $query->where('stock', '>', 0);
        }

        if($sort=="ASC" && $order=="price"){

             return $query->orderBy(DB::raw("stock>0 DESC , CASE WHEN special>0 THEN special else price END"))->paginate($limit);
        }else if($sort=="DESC" && $order=="price"){
               return $query->orderBy(DB::raw("CASE WHEN stock > 0 AND special>0 THEN special WHEN stock > 0 THEN price END"), $sort)->orderBy('stock', 'DESC')->paginate($limit);

        }else{
          return $query->orderBy(DB::raw("CASE WHEN stock > 0 THEN $order END"), $sort)->orderBy('stock', 'DESC')->paginate($limit);
        }
    }

    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class);
    }

    public function manufacturersHasLogo()
    {
        return $this->belongsToMany(Manufacturer::class)->whereNotNull('logo')->take(3);
    }

    public function getProducts()
    {
        return $this->products()->where('status', 1)->latest()->paginate();
    }

    public function getProductsInStockWithSortOrder()
    {
        // return $this->products()
        //     ->with('attributes')
        //     // ->where('stock', '>', 0)
        //     ->orderBy('stock', 'DESC')
        //     ->orderBy('sort_order', 'DESC')
        //     ->paginate(24);
        return $this->products()->where('status', 1)->with('attributes')->orderBy(DB::raw("CASE WHEN stock > 0 THEN sort_order END"), "DESC")->orderBy('stock', 'DESC')->paginate(24);

    }

    public function getProductsWithAttributes()
    {
        return $this->products()->where('status', 1)->with('attributes')->orderBy(DB::raw("CASE WHEN stock > 0 THEN sort_order END"), "DESC")->orderBy('stock', 'DESC')->paginate(24);
    }

    public function getMostExpensiveProduct()
    {
        return $this->products()->where('status', 1)->latest('price')->first();
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function getNameSlugAttribute()
    {
        return "{$this->name} ({$this->slug})";
    }

    public function getProductsWithAttributesTest()
    {
        return $this->products()->with('attributes')->where('status', 1)->where('stock','>','0')->orderBy('sort_order', 'DESC')->paginate(24);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    
    public function scopePublished($query)
    {
        return $query->where('status', true);
    }
    
    public function scopeMenu($query)
    {
        return $query->where('show_in_menu', true);
    }
    
    public function scopeIndex($query)
    {
        return $query->where('is_noindex', false);
    }

    public function scopeNoIndex($query)
    {
        return $query->where('is_noindex', true);
    }

    public function scopeFollow($query)
    {
        return $query->where('is_nofollow', false);
    }

    public function scopeNoFollow($query)
    {
        return $query->where('is_nofollow', true);
    }
}
