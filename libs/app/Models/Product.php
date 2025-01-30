<?php

namespace App\Models;

use App\Observers\ProductObserver;
use App\Services\StringService;
use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    use LoggableRelations;

    protected $fillable = [
        'name',
        'label',
        'slug',
        'user_id',
        'category_id',
        'is_foreign',
        'description',
        'title',
        'meta_keywords',
        'meta_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'manufacturer_id',
        'model',
        'length',
        'width',
        'height',
        'weight',
        'length_unit',
        'weight_unit',
        'src',
        'sort_order',
        'count_star',
        'price',
        'special',
        'colleague_price',
        'discount',
        'stock',
        'status',
        'suggest',
        'variety_label',
        'variety_value',
        'giftcard',
        'badge',
        'warranty',
        'image',
        'alt',
        'hide_price',
        'catalogue',
        'catalogue_name',
        'total_sales_count',
        'order_sales_count',
        'total_monthly_sales_count',
        'user_sales_count',
        'is_installment',
        'required_national_id',
        'is_festival',
        'is_available',
        'dev_title',
    ];

    protected $logRelations = [
        'user' => ['id', 'name'],
        'category' => ['id', 'name', 'slug'],
        'manufacturer' => ['id', 'name', 'slug'],
        'attributes' => ['id', 'name', 'pivot' => ['value', 'highlight']],
        'filters' => ['id', 'name'],
        'categories' => ['id', 'name', 'slug'],
        'images' => ['id', 'image', 'alt'],
        'warranties' => ['id', 'name', 'slug'],
        'relatedProducts' => ['id', 'name', 'slug'],
        'crossProducts' => ['id', 'name', 'slug'],
    ];

    protected $logOnly = [
        'name',
        'label',
        'slug',
        'is_foreign',
        'description',
        'title',
        'meta_keywords',
        'meta_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'price',
        'special',
        'colleague_price',
        'stock',
        'status',
        'suggest',
        'variety_label',
        'variety_value',
        'giftcard',
        'badge',
        'warranty',
        'image',
        'alt',
        'hide_price',
        'catalogue',
        'catalogue_name',
        'is_installment',
        'required_national_id',
        'is_festival',
        'is_available',
        'discount',
    ];

    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'label' => 'لیبل',
        'slug' => 'اسلاگ',
        'user_id' => 'کاربر',
        'user' => 'کاربر',
        'category_id' => 'دسته بندی اصلی',
        'category' => 'دسته بندی اصلی',
        'is_foreign' => 'کالای خارجی',
        'description' => 'توضیحات',
        'title' => 'تایتل',
        'meta_keywords' => 'کلمات کلیدی',
        'meta_description' => 'دسکریپشن',
        'og_image' => 'عکس اپن گراف',
        'twitter_title' => 'تایتل توئیتر',
        'twitter_description' => 'دسکریپشن توئیتر',
        'twitter_image' => 'تصویر توئیتر',
        'canonical' => 'کنونیکال',
        'is_nofollow' => 'نوفالو',
        'is_noindex' => 'نوایندکس',
        'manufacturer_id' => 'تولیدکننده',
        'manufacturer' => 'تولیدکننده',
        'model' => 'مدل',
        'length' => 'طول',
        'width' => 'عرض',
        'height' => 'ارتفاع',
        'weight' => 'وزن',
        'length_unit' => 'واحد ارتفاع',
        'weight_unit' => 'واحد وزن',
        'src' => 'سورس',
        'sort_order' => 'ترتیب',
        'count_star' => 'تعداد ستاره‌ها',
        'price' => 'قیمت',
        'special' => 'قیمت ویژه',
        'colleague_price' => 'قیمت همکار',
        'stock' => 'موجودی',
        'status' => 'وضعیت',
        'suggest' => 'کالای پیشنهادی',
        'variety_label' => 'لیبل تنوع',
        'variety_value' => 'مقدار تنوع',
        'giftcard' => 'کارت هدیه',
        'badge' => 'بج',
        'warranty' => 'گارانتی',
        'image' => 'تصویر',
        'alt' => 'alt',
        'hide_price' => 'قیمت مخفی',
        'catalogue' => 'کاتالوگ',
        'catalogue_name' => 'نام کاتالوگ',
        'total_sales_count' => 'مبلغ کل فروش',
        'order_sales_count' => 'تعداد فروش سفارش',
        'total_monthly_sales_count' => 'مبلغ کل فروش ماهیانه',
        'user_sales_count' => 'تعداد کل کاربران',
        'is_installment' => 'کالای قسطی',
        'required_national_id' => 'کد ملی الزامی',
        'is_festival' => 'جشنواره',
        'is_available' => 'موجود',
        'discount' => 'درصد تخفیف',
        'created_at' => 'تاریخ ایجاد',
        'updated_at' => 'تاریخ ویرایش',
        'available_at' => 'تاریخ پایان در دسترس بودن',
        'special_started_at' => 'تاریخ شروع فروش ویژه',
        'special_ended_at' => 'تاریخ پایان فروش ویژه',
        'categories' => 'دسته بندی‌ها',
        'relatedProducts' => 'محصولات مرتبط',
        'crossProducts' => 'محصولات مکمل',
        'filters' => 'فیلترها',
        'warranties' => 'گارانتی‌ها',
        'attributes' => 'خصوصیات',
        'images' => 'تصاویر',
        'value' => 'مقدار',
        'highlight' => 'هایلایت',
    ];


    public static function boot()
    {
        $service = app(StringService::class) ;
        parent::boot();
        static::saving(function ($model) use ($service) {
            $model->dev_title = $service->setDevTitle($model->title);
        });
    }

    public function getLabel(string $field): string
    {
        return $this->translations[$field] ?? $field;
    }

    public function getLogRelations(): array
    {
        return $this->logRelations;
    }

    public function getLogRelation(string $relation): ?array
    {
        return $this->logRelations[$relation] ?? null;
    }

    public function getLogOnly(): array
    {
        return $this->logOnly;
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'hide_price' => 'boolean',
            'is_foreign' => 'boolean',
            'total_sales_count' => 'integer',
            'order_sales_count' => 'integer',
            'user_sales_count' => 'integer',
            'total_monthly_sales_count' => 'integer',
            'is_nofollow' => 'boolean',
            'is_noindex' => 'boolean',
            'required_national_id' => 'boolean',
            'is_festival' => 'boolean',
            'discount' => 'integer',
        ];
    }

    protected $type = [
        'name' => 'string',
        'label' => 'string',
        'slug' => 'string',
        'user_id' => 'relation',
        'category_id' => 'relation',
        'is_foreign' => 'boolean',
        'description' => 'string',
        'title' => 'string',
        'meta_keywords' => 'string',
        'meta_description' => 'string',
        'og_image' => 'string',
        'twitter_title' => 'string',
        'twitter_description' => 'string',
        'twitter_image' => 'image',
        'canonical' => 'string',
        'is_nofollow' => 'boolean',
        'is_noindex' => 'boolean',
        'manufacturer_id' => 'relation',
        'price' => 'price',
        'special' => 'price',
        'colleague_price' => 'price',
        'stock' => 'integer',
        'status' => 'boolean',
        'suggest' => 'boolean',
        'variety_label' => 'string',
        'variety_value' => 'string',
        'giftcard' => 'string',
        'badge' => 'string',
        'warranty' => 'string',
        'image' => 'image',
        'alt' => 'string',
        'hide_price' => 'boolean',
        'catalogue' => 'string',
        'catalogue_name' => 'string',
        'is_installment' => 'boolean',
        'required_national_id' => 'boolean',
        'is_festival' => 'boolean',
        'is_available' => 'boolean',
        'discount' => 'decimal',
    ];

    public function getFieldType(string $field): string
    {
        return $this->type[$field] ?? 'string';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)
            ->withPivot('value', 'highlight')->orderBy('sort_order', 'DESC');
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class);
    }

    public function search($filters)
    {
        return $this->hasManyThrough(Product::class, Filter::class)->whereIn('filter_id', $filters)->get();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function warranties()
    {
        return $this->belongsToMany(Warranty::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'reviews');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function approvedReviews()
    {
        return $this->reviews()->where('status', 1);
    }

    public static function getlatest()
    {
        return static::with('approvedReviews')->where(['status' =>1])->extant()->latest()->take(10)->get();
    }

    public static function getMostPopular()
    {
        return static::with('approvedReviews')->where('status', 1)->extant()->latest('view_counts')->take(10)->get();
    }

    public static function getForeignProducts()
    {
        return static::where('is_foreign', true)->extant()->where('status', 1)->latest('view_counts')->take(10)->get();
    }

    public static function getMostStock()
    {
        return static::with('approvedReviews')->where('status', 1)->extant()->latest('stock')->take(10)->get();
    }

    public static function getSuggests()
    {
        return static::where(['status' => 1, 'suggest' => 1])->extant()->latest()->take(12)->get();
    }

    public function wishlist()
    {
        return $this->belongsToMany(User::class)->wherePivot('is_notification', false);
    }

    public function notifications()
    {
        return $this->belongsToMany(User::class, 'wishlist')->wherePivot('is_notification', true);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function scopeExtant($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function scopeInstallment($query)
    {
        return $query->where('is_installment', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_product_id');
    }

    public function crossProducts()
    {
        return $this->belongsToMany(Product::class, 'cross_products', 'product_id', 'cross_product_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', true);
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

    public function scopeFestival($query)
    {
        return $query->where('is_festival', true);
    }

    public function scopeNotFestival($query)
    {
        return $query->where('is_festival', false);
    }
}
