<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Attribute;
use App\Models\AttributeGroups;
use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterGroup;
use App\Models\Manufacturer;
use App\Models\Note;
use App\Models\AttributeProduct;
use App\Models\CategoryProduct;
use App\Models\FilterProduct;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Warranty;
use App\Http\Requests\ImportExcel;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Http\Requests\CloneRequest;
use App\Models\Unit;
use App\Services\ActivityLogService;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Sms;

class ProductController extends Controller
{
    protected $activityLogService;

    /**
     * ProductController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:products-manage');
        $this->activityLogService = $activityLogService;
    }

    public function index()
    {
           $categories = Category::orderBy('parent_id')->get();
           return view('admin.products.index', compact('categories'));
    }

    public function ajax($category,$quantity)
    {
        if($category == 0) {
            $products = DB::table('products')->select('products.id', 'products.image', 'products.created_at', 'products.manual_updated_at', 'products.name', 'products.slug', 'products.model', 'products.price', 'products.special', 'products.stock', 'products.status','products.dev_title');
            if($quantity == 1) {
                $products = $products ->where('stock', '!=', 0);
            } else if($quantity == 2) {
                $products = $products ->where('stock', '=', 0);
            }
        } else {
            $products = DB::table('products')->join('category_product', 'products.id', '=', 'category_product.product_id')->where('category_id','=',$category)->select('products.id', 'products.image', 'products.created_at', 'products.manual_updated_at', 'products.name', 'products.slug', 'products.model', 'products.price', 'products.special', 'products.stock', 'products.status');
            if($quantity == 1){
                $products = $products ->where('stock', '!=', 0);
            } else if($quantity == 2){
                $products = $products ->where('stock', '=', 0);
            }
        }

        return Datatables::of($products)
            ->setTotalRecords($products->count())
            ->orderColumn('created_at', 'created_at $1')
            ->editColumn('image', function ($product) {
                return '<img src="' . asset(image_resize($product->image, ['width' => 40, 'height' => 40])) . '" class="img-responsive img-thumbnail">';
            })
            ->editColumn('price', function ($product) {
                return number_format($product->price, 0);
            })
            ->editColumn('special', function ($product) {
                return  number_format($product->special, 0);
            })
            ->editColumn('created_at', function ($product) {
                return jdate($product->created_at)->format('d F Y ساعت H:i');
            })
            ->editColumn('manual_updated_at', function ($product) {
                return jdate($product->manual_updated_at)->format('d F Y ساعت H:i');
            })
            ->editColumn('status', function ($product) {
                return $product->status ? '<span class="label label-success">فعال</span>' : '<span class="label label-warning">غیرفعال</span>';
            })
            ->addColumn('action', function ($product) {
                return view('admin.partials.products', compact('product'));
            })
            ->rawColumns(['image', 'price', 'stock', 'status', 'action'])
            ->make(true);
    }


    public function create(Request $request)
    {
        $manufacturers  = Manufacturer::get()->pluck('name', 'id')->toArray();
        $cats           = Category::get();
        $categories     = [];
        foreach ($cats as $cat) {
            $categories[$cat->id] = "{$cat->name} ({$cat->slug})";
        }
        $filters        = Filter::get()->pluck('filter', 'id');
        $warranties     = Warranty::get()->pluck('name', 'id');
        $attributes     = Attribute::get()->pluck('name', 'id');
        $pros         = Product::get();
        $products     = [];
        foreach ($pros as $pro) {
           $products[$pro->id] = "{$pro->name} ({$pro->slug})";
        }
        $categoryAttributes = [];
        if($request->input('category_id')) {
            $category = Category::with(['attributeGroups.attributes'])->findOrFail($request->input('category_id'));
            $categoryAttributes = $category->attributeGroups;
        }
        return view('admin.products.create', compact('manufacturers', 'categories', 'warranties', 'filters', 'attributes', 'products', 'categoryAttributes'));
    }


    public function store(StoreProduct $request)
    {
        $productData = $request->only(['name', 'label', 'variety_label', 'variety_value', 'alt', 'slug', 'description', 'title', 'meta_description', 'manufacturer_id', 'model', 'giftcard', 'badge', 'suggest', 'warranty', 'price', 'count_star', 'sort_order', 'length', 'width', 'height', 'weight', 'length_unit', 'weight_unit', 'src', 'stock', 'status', 'hide_price', 'catalogue_name', 'twitter_title', 'twitter_description', 'canonical']);
        $productData['user_id'] = Auth::user()->id;
        $productData['is_foreign'] = $request->input('is_foreign', false);
        $productData['is_installment'] = $request->input('is_installment', false);
        $productData['is_nofollow'] = $request->input('is_nofollow', false);
        $productData['is_noindex'] = $request->input('is_noindex', false);
        $productData['is_festival'] = $request->input('is_festival', false);
        $productData['is_available'] = $request->input('is_available', false);
        $productData['required_national_id'] = $request->input('required_national_id', false);
        $productData['manual_updated_at'] = now();
        if ($request->hasFile('image')) {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->image->storeAs('public/images/products/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension())) {
                $productData['image'] = 'storage/images/products/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/products/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $productData['og_image'] = 'storage/images/products/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/products/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $productData['twitter_image'] = 'storage/images/products/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('catalogue')) {
            $name = pathinfo($request->catalogue->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->catalogue->storeAs('public/images/products/catalogue/' . date('Y/m'), $name . '.' . $request->catalogue->extension())) {
                $productData['catalogue'] = 'storage/images/products/catalogue/' . date('Y/m') . '/' . $name . '.' . $request->catalogue->extension();
            }
        }
        if($request->input('special')) {
            $productData['special'] = $request->input('special');
            $productData['discount'] = (int) round(100 - $productData['special'] * 100 / $productData['price']);
        }
        if($request->input('colleague_price')) {
            $productData['colleague_price'] = $request->input('special');
        }

        $product = Product::create($productData);

        // Sync relations
        $product->categories()->sync($request->input('category_id'));
        $product->relatedProducts()->sync($request->input('product_id'));
        $product->crossProducts()->sync($request->input('cross_product_id'));
        $product->filters()->sync($request->input('filter_id'));
        $product->warranties()->sync($request->input('warranty_id'));

        // Set main category_id
        foreach($product->categories as $category) {
            if($category->children()->count() == 0) {
                $product->update(['category_id' => $category->id]);
                break;
            }
        }

        $attributes = [];
        if ($request->input('attribute_id')) {
            foreach ($request->input('attribute_id') as $key => $attribute) {
                if ($request->input('attribute_value.' . $key)) {
                      $attributes[$request->input('attribute_id.' . $key)] = [
                        'value' => $request->input('attribute_value.' . $key),
                        'highlight' => $request->input('attribute_highlight.' . $key) ?1: 0,
                    ];
                }
            }
        }
        $product->attributes()->sync($attributes);

        if ($request->hasfile('images')) {
            $date = date('Y/m');
            $images = [];
            foreach ($request->file('images') as $key => $file) {
                $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                if ($file->storeAs('public/images/products/' . $date, $name . '.' . $file->getClientOriginalExtension())) {
                    $image = 'storage/images/products/' . $date . '/' . $name . '.' . $file->getClientOriginalExtension();
                }

                $sort_order = ($request->input('images_sort_order.' . $key) ?? NULL);
                $alt = ($request->input('images_alt.' . $key) ?? NULL);

                $images[] = [
                    'product_id' => $product->id,
                    'image' => $image,
                    'sort_order' => $sort_order,
                    'alt' => $alt,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            ProductImages::insert($images);
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "محصول $product->name ایجاد شد."
        ]);

        return redirect()->route('admin.products.index');
    }

    public function export()
    {
        $manufacturers = Manufacturer::pluck('name', 'id');
        return view('admin.products.export', compact('manufacturers'));
    }

    public function exportExcel(Request $request)
    {
        $productsQuery  = Product::with('manufacturer');
        if($request->input('manufacturer_id')) {
            $productsQuery->where('manufacturer_id', $request->input('manufacturer_id'));
        }
        if ($request->filled('min_stock')) {
            $productsQuery->where('stock', '>=', $request->input('min_stock'));
        }

        if ($request->filled('max_stock')) {
            $productsQuery->where('stock', '<=', $request->input('max_stock'));
        }

        if ($request->filled('min_price')) {
            $productsQuery->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $productsQuery->where('price', '<=', $request->input('max_price'));
        }

        if ($request->has('status') && $request->input('status') !== '' && $request->input('status') !== null) {
            $productsQuery->where('status', $request->input('status'));
        }
        $products   = $productsQuery->get();
        return (new FastExcel($products))->download('products.xlsx', function ($product) {
            return [
                'slug'              => $product->slug,
                'model'             => $product->model,
                'name'              => $product->name,
                'stock'             => $product->stock,
                'manufacturer'      => $product->manufacturer->name ?? '',
                'price'             => number_format($product->price, 0, '', ''),
                'special'           => $product->special ? number_format($product->special, 0, '', '') : null,
                'colleague_price'   => $product->colleague_price ? number_format($product->colleague_price, 0, '', '') : null,
            ];
        });
    }

    public function import()
    {
        return view()->first(['admin.products.import', 'Product::import']);
    }

    public function importExcel(importExcel $request)
    {
        $sheets = (new FastExcel)->importSheets($request->excel);
        $products = $sheets[0];
        $attributes = $sheets[1];
        $filters = $sheets[2];
        $images = $sheets[3];
        $categories = $sheets[4];

        // Insert products
        $products_data = [];
        foreach ($products as $key => $row) {
            if (empty($row['name'])) {
                $errors[] = 'فیلد name نباید خالی باشد. محصول ' . ($key - 1) . ' باید مجددا در دیتابیس وارد شود.';
                continue;
            } elseif (empty($row['slug'])) {
                $errors[] = 'فیلد slug نباید خالی باشد. محصول ' . ($key - 1) . ' باید مجددا در دیتابیس وارد شود.';
                continue;
            } elseif (empty($row['price'])) {
                $errors[] = 'فیلد price نباید خالی باشد. محصول' . ($key - 1) . ' باید مجددا در دیتابیس وارد شود.';
                continue;
            } elseif (empty($row['manufacturer'])) {
                $errors[] = 'فیلد manufacturer نباید خالی باشد. محصول ' . ($key - 1) . ' باید مجددا در دیتابیس وارد شود.';
                continue;
            }
            $products_data[] = [
                "name" => $row['name'],
                "slug" => $row['slug'],
                "description" => $row['description'],
                "model" => $row['model'],
                'user_id' => auth()->user()->id,
                "stock" => (int)$row['stock'],
                "image" => $row['image'],
                "manufacturer_id" => Manufacturer::select('id')->where('name', $row['manufacturer'])->get()->first()->toArray()['id'],
                "price" => (float)$row['price'],
                "meta_description" => $row['meta_description'],
                "status" => (int)$row['status'],
                "src" => $row['src'],
                "created_at" => now(),
                "updated_at" => now(),
            ];
            if ($row['special']) {
                $products_data['special'] = $row['special'];
                $products_data['special_started_at'] = empty($row['special_started_at']) ? null : $row['special_started_at'];
                if (!is_int($row['special_ended_at'])) {
                    $errors[] = 'تاریخ انقضا، باید تعداد روز از امروز باشد. خطا در محصول ردیف' . ($key - 1) . ' با اسلاگ ' . $row['slug'] . ' رخ داده است.';
                    $products_data['special_ended_at'] = null;
                } else {
                    $products_data['special_ended_at'] = (empty($row['special_ended_at']) OR is_null($row['special_ended_at']) ? null : now()->addDay($row['special_ended_at']));
                }
                $products_data['discount'] = (int) round(100 - $row['special'] * 100 / $row['price']);
            }
        }
        Product::insert($products_data);
        $products = Product::whereIn('slug', Arr::pluck($products, 'slug'))->pluck('id', 'slug');

        if ($products->count()) {
            // Insert attributes
            if (isset($attributes[0])) {
                $attributesFromDB = Attribute::whereIn('name', array_keys($attributes[0]))->pluck('name', 'id');
                $productsAttributes = [];
                foreach ($attributes as $key => $attrs) {
                    // Iterate inside a row for dynamic column name
                    foreach ($attributesFromDB as $attrID => $attrName) {
                        if (!empty($attrName) && $attrID != 'slug') {
                            if (!isset($products[$attrs['slug']])) {
                                $errors[] = ' اسلاگ' . $attrs['slug'] . ' وارد شده در تب خصوصیات وجود ندارد.';
                                continue;
                            }
                            if (!isset($attrs[$attrName])) {
                                $errors[] = ' ویژگی ' . $attrName . ' وارد شده در تب خصوصیات مربوط به اسلاگ ' . $attrs['slug'] . ' تعریف نشده است. ';
                                continue;
                            }
                            $productsAttributes[] = [
                                'attribute_id' => $attrID,
                                'product_id' => $products[$attrs['slug']],
                                'highlight' => 0,
                                'value' => $attrs[$attrName],
                            ];
                        }
                    }
                }
                AttributeProduct::insert($productsAttributes);
            }

            // Insert filters
            if (isset($filters[0])) {
                $filtersFromDB = Filter::pluck('id', 'name');
                $filtersKeys = array_keys($filters[0]);
                $productsFilters = [];
                $filterColumnsCount = count($filtersKeys);
                foreach ($filters as $row) {
                    // Iterate inside a row for dynamic column name
                    for ($i = 0; $i < $filterColumnsCount; $i++) {
                        if (!empty($filtersKeys[$i]) && $filtersKeys[$i] != 'slug' && !empty($row[$filtersKeys[$i]])) {
                            if (!isset($products[$row['slug']]) && !empty($row['slug'])) {
                                $errors[] = ' اسلاگ' . $row['slug'] . ' وارد شده در تب فیلترها وجود ندارد.';
                                continue;
                            }
                            if (!isset($filtersFromDB[$row[$filtersKeys[$i]]])) {
                                $errors[] = 'فیلتر ' . $row[$filtersKeys[$i]] . ' وارد شده در تب فیلترها مربوط به اسلاگ ' . $row['slug'] . ' تعریف نشده است.';
                                continue;
                            }
                            $productsFilters[] = [
                                'filter_id' => $filtersFromDB[$row[$filtersKeys[$i]]],
                                'product_id' => $products[$row['slug']],
                            ];
                        }
                    }
                }
                FilterProduct::insert($productsFilters);
            }

            // Insert categories
            if (isset($categories[0])) {
                $categoriesFromDB = Category::pluck('id', 'slug');
                $categoriesKeys = array_keys($categories[0]);
                $categoryColumnCount = count($categoriesKeys);
                $productsCategories = [];
                foreach ($categories as $row) {
                    // Iterate inside a row for dynamic column name
                    for ($i = 0; $i < $categoryColumnCount; $i++) {
                        if (!empty($categoriesKeys[$i]) && $categoriesKeys[$i] != 'slug' && !empty($row[$categoriesKeys[$i]])) {
                            if (!isset($products[$row['slug']])) {
                                $errors[] = 'اسلاگ ' . $row['slug'] . ' وارد شده در تب دسته‌بندی وجود ندارد.';
                                continue;
                            }
                            if (!isset($row[$categoriesKeys[$i]], $categoriesFromDB[$row[$categoriesKeys[$i]]])) {
                                $errors[] = ' دسته‌بندی ' . $row[$categoriesKeys[$i]] . ' وارد شده در تب دسته‌بندی‌ها مربوط به اسلاگ ' . $row['slug'] . ' وجود ندارد. ';
                                continue;
                            }
                            $productsCategories[] = [
                                'category_id' => $categoriesFromDB[$row[$categoriesKeys[$i]]],
                                'product_id' => $products[$row['slug']],
                            ];
                        }
                    }
                }
                CategoryProduct::insert($productsCategories);
            }

            // Insert images
            if (isset($images[0])) {
                $imagesKeys = array_keys($images[0]);
                $imagesColumnCount = count($images[0]);
                $productsImages = [];
                foreach ($images as $row) {
                    // Iterate inside a row for dynamic column name
                    for ($i = 0; $i < $imagesColumnCount; $i++) {
                        if (!isset($products[$row['slug']])) {
                            $errors[] = ' اسلاگ ' . $row['slug'] . ' وارد شده در تب تصاویر وجود ندارد. ';
                            continue;
                        }
                        if (!empty($row[$imagesKeys[$i]]) && $imagesKeys[$i] != 'slug') {
                            $productsImages[] = [
                                'product_id' => $products[$row['slug']],
                                'image' => $imagesKeys[$i],
                                'sort_order' => null,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ];
                        }
                    }
                }
                ProductImages::insert($productsImages);
            }

        } else {
            $errors[] = 'هیچ محصولی در فایل اکسل شما وجود ندارد!';
        }

        if (isset($errors)) {
            return back()->withErrors($errors);
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "محصولات فایل اکسل با موفقیت در دیتابیس ایمپورت شدند."
        ]);

        return redirect()->route('admin.products.index');
    }


    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $product->load('categories.attributeGroups.attributes', 'filters', 'attributes', 'notes.user');
        $this->addAttributes($product);
        $product->load('attributes');
        $manufacturers  = Manufacturer::pluck('name', 'id')->toArray();
        $cats           = Category::get();
        $categories     = [];
        foreach ($cats as $cat) {
            $categories[$cat->id] = "{$cat->name} ({$cat->slug})";
        }
        $selectedCategories     = array_pluck($product->categories->toArray(), 'id');
        $filters                = Filter::with('filterGroup')->get();
        $selectedFilters        = array_pluck($product->filters->toArray(), 'id');
        $warranties             = Warranty::get()->pluck('name', 'id');
        $selectedWarranties     = array_pluck($product->warranties->toArray(), 'id');
        $attributes             = Attribute::get()->pluck('name', 'id');
        $selectedAttributes     = [];
        $highlightedAttributes  = [];
        foreach ($product->attributes->toArray() as $attribute) {
            $selectedAttributes[$attribute['id']] = $attribute['pivot']['value'];
            if ($attribute['pivot']['highlight']) {
                $highlightedAttributes[] = $attribute['id'];
            }
        }

        $pros           = Product::where('id', '!=', $product->id)->get();
        $products     = [];
        foreach ($pros as $pro) {
            $products[$pro->id] = "{$pro->name} ({$pro->slug})";
        }
        $selectedProducts      = array_pluck($product->relatedProducts->toArray(), 'id');
        $selectedCrossProducts = array_pluck($product->crossProducts->toArray(), 'id');
        return view('admin.products.edit', compact('product', 'manufacturers', 'categories', 'warranties', 'selectedWarranties', 'filters', 'attributes', 'selectedCategories', 'selectedAttributes', 'selectedFilters', 'highlightedAttributes','products','selectedProducts', 'selectedCrossProducts'));
    }

    /**
     * Showing an input to bulk edit products using excel.
     *
     * @return mixed
     */
    public function bulkEdit()
    {
        return view('admin.products.bunch-edit');
    }

    /**
     * Bulk edit using excel file.
     *
     * @param ImportExcel $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
     */
    public function bulkImport(importExcel $request)
    {
        $excel_data = (new FastExcel)->import($request->excel);
        if ($excel_data) {
            foreach ($excel_data as $key => $row) {
                $product = Product::where('slug', $row['slug'])->get()->first();
                if (!$product) {
                    $error[] = 'محصولی با اسلاگ ' . $row['slug'] . ' وجود ندارد.';
                    continue;
                }
                //$product->stock = $row['stock'];
                //$product->status = $row['status'];
                $product->price = $row['price'];
                $product->special = $row['special'] ?? null;
                $product->colleague_price = $row['colleague_price'] ?? null;
                $product->updated_at = date('Y-m-d H:i:s');

                /*if ($row['special']) {
                    $product->special = $row['special'];
                    $product->special_started_at = empty($row['special_started_at']) ? null : $row['special_started_at'];
                    $product->special_ended_at = empty($row['special_ended_at']) ? null : $row['special_ended_at'];
                    $product->discount = (int) round(100 - $row['special'] * 100 / $row['price']);
                }*/

                $product->save();
            }
        }
        success("محصولات فایل اکسل با موفقیت آپدیت شدند.");
        return redirect()->route('admin.products.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProduct  $request
     * @param  Product  $product
     * @return Response
     */
    public function update(UpdateProduct $request, Product $product)
    {
        $log = $this->activityLogService->init('محصول', 'updated')->prepare($product, 'old');
        $notify = !$product->stock && $request->stock >= 1;
        $fields = [
            'name', 'label', 'variety_label', 'variety_value', 'slug', 'alt',
            'description', 'title', 'meta_description', 'manufacturer_id',
            'model', 'length', 'width', 'height', 'weight', 'length_unit',
            'weight_unit', 'src', 'suggest', 'giftcard', 'badge', 'warranty',
            'sort_order', 'count_star', 'price', 'stock', 'status', 'hide_price',
            'is_foreign', 'is_installment', 'is_nofollow', 'is_noindex',
            'catalogue_name', 'twitter_title', 'twitter_description', 'canonical',
            'required_national_id', 'is_festival', 'is_available'
        ];
        foreach ($fields as $field) {
            $product->$field = $request->input($field, $product->$field);
        }
        $product->is_foreign = $request->input('is_foreign', false);
        $product->is_installment = $request->input('is_installment', false);
        $product->is_nofollow = $request->input('is_nofollow', false);
        $product->is_noindex = $request->input('is_noindex', false);
        $product->required_national_id = $request->input('required_national_id', false);
        $product->is_festival = $request->input('is_festival', false);
        $product->is_available = $request->input('is_available', false);
        $product->manual_updated_at = now();

        if ($request->input('special')) {
            $product->special = $request->input('special');
            $product->discount = (int) round(100 - $request->input('special') * 100 / $request->input('price'));
        } else {
            $product->special = null;
            $product->discount = null;
        }

        if ($request->input('colleague_price')) {
            $product->colleague_price = $request->input('colleague_price');
        }

        if ($request->hasFile('image')) {
            $product->image = $this->uploadImage($request->file('image'), 'products');
        }

        $product->twitter_image = $this->updateOptionalImage($request, 'twitter_image', 'products');
        $product->og_image = $this->updateOptionalImage($request, 'og_image', 'products');

        if ($request->input('remove_catalogue')) {
            $product->catalogue = null;
            $product->catalogue_name = null;
        }
        else
        {
            $product->catalogue = $this->updateOptionalImage($request, 'catalogue', 'products/catalogue');
        }

        $product->save();

        $relations = [
            'categories' => $request->input('category_id'),
            'relatedProducts' => $request->input('product_id'),
            'crossProducts' => $request->input('cross_product_id'),
            'filters' => $request->input('filter_id'),
            'warranties' => $request->input('warranty_id')
        ];
        foreach ($relations as $relation => $ids) {
            $product->$relation()->sync($ids);
        }

        foreach ($product->categories as $category) {
            if ($category->children()->count() === 0) {
                $product->update(['category_id' => $category->id]);
                break;
            }
        }

        $attributes = $this->syncAttributes($request);
        $product->attributes()->sync($attributes);

        $this->syncImages($request, $product);

        $log->prepare($product)->finalize()->save();

        if ($notify) {
            $this->sendNotify($product);
        }

        success("محصول {$product->name} آپدیت شد.");
        return redirect()->route('admin.products.index');
    }

    /**
     * Upload image
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @return string
     */
    private function uploadImage($file, $path)
    {
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "storage/images/{$path}/" . date('Y/m') . "/{$name}." . $file->getClientOriginalExtension();
        $file->storeAs("public/images/{$path}/" . date('Y/m'), "{$name}." . $file->getClientOriginalExtension());
        return $filePath;
    }

    /**
     * Upload optional images
     *
     * @param Request $request
     * @param string $field
     * @param string $path
     * @return string|null
     */
    private function updateOptionalImage(Request $request, $field, $path)
    {
        return $request->hasFile($field) ? $this->uploadImage($request->file($field), $path) : null;
    }

    /**
     * Sync attributes
     *
     * @param Request $request
     * @return array
     */
    private function syncAttributes(Request $request)
    {
        $attributes = [];
        if ($request->input('attribute_id')) {
            foreach ($request->input('attribute_id') as $key => $attribute) {
                if ($request->input('attribute_value.' . $key)) {
                    $attributes[$attribute] = [
                        'value' => $request->input('attribute_value.' . $key),
                        'highlight' => $request->input('attribute_highlight.' . $key) ?? 0,
                    ];
                }
            }
        }
        return $attributes;
    }

    /**
     * Sync images
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    private function syncImages(Request $request, Product $product)
    {
        // Update existing images
        if ($request->input('keep_images_alt')) {
            foreach ($request->input('keep_images_alt') as $id => $alt) {
                $sort_order = $request->input("keep_images_sort_order.{$id}", null);
                $product->images()->where('id', $id)->update(['alt' => $alt, 'sort_order' => $sort_order]);
            }
        }

        // Remove old images
        $oldImages = $request->input('keep_images') ?
            array_diff(array_column($product->images->toArray(), 'id'), $request->input('keep_images')) :
            array_column($product->images->toArray(), 'id');
        $product->images()->whereIn('id', $oldImages)->delete();

        // Add many images
        if ($request->hasFile('images')) {
            $date = date('Y/m');
            $images = [];
            foreach ($request->file('images') as $key => $file) {
                $imagePath = $this->uploadImage($file, 'products');
                $images[] = [
                    'product_id' => $product->id,
                    'image' => $imagePath,
                    'sort_order' => $request->input("images_sort_order.{$key}", null),
                    'alt' => $request->input("images_alt.{$key}", null),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            ProductImages::insert($images);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the category
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $product = Product::findOrFail($id);
        $product->delete();
        success();
        return redirect()->route('admin.products.index');
    }

    protected function sendNotify($product)
    {
        // $message = 'با سلام' . "\n" . $product->name . ' موجود شد.' . "\n" . 'با تشکر' . "\n" . url(route('products.show', $product));
        $link=(route('products.show', $product));

        foreach ($product->notifications as $notification) {
            // send_sms($notification->mobile, $message);
            // Sms::ultraFastSend(['user'=>$notification->name, 'product'=> $product->name,'link'=>$link],67286,$notification->mobile);
            //Sms::ultraFastSend(['user'=>$notification->name, 'product'=> $product->name],78811,$notification->mobile);
        }

        $product->notifications()->detach();
    }

    public function clone(Product $product)
    {
        $product->load('categories.attributeGroups.attributes', 'filters', 'attributes');
        $this->addAttributes($product);
        $product->load('attributes');
        $manufacturers  = Manufacturer::pluck('name', 'id')->toArray();
        $cats           = Category::get();
        $categories     = [];
        foreach ($cats as $cat) {
            $categories[$cat->id] = "{$cat->name} ({$cat->slug})";
        }
        $selectedCategories     = array_pluck($product->categories->toArray(), 'id');
        $filters                = Filter::with('filterGroup')->get();
        $warranties             = Warranty::query()->pluck('name', 'id');
        $selectedFilters        = array_pluck($product->filters->toArray(), 'id');
        $selectedWarranties     = array_pluck($product->warranties->toArray(), 'id');
        $attributes             = Attribute::get()->pluck('name', 'id');
        $selectedAttributes     = [];
        $highlightedAttributes  = [];
        foreach ($product->attributes->toArray() as $attribute) {
            $selectedAttributes[$attribute['id']] = $attribute['pivot']['value'];
            if ($attribute['pivot']['highlight']) {
                $highlightedAttributes[] = $attribute['id'];
            }
        }
        $pros = Product::where('id','!=',$product->id)->get();
        $products = [];
        foreach ($pros as $pro) {
            $products[$pro->id] = "{$pro->name} ({$pro->slug})";
        }
        $selectedProducts     = array_pluck($product->relatedProducts->toArray(), 'id');
        $selectedCrossProducts = array_pluck($product->crossProducts->toArray(), 'id');
        return view('admin.products.clone', compact('product', 'manufacturers', 'warranties', 'selectedWarranties', 'categories', 'filters', 'attributes', 'selectedCategories', 'selectedAttributes', 'selectedFilters', 'highlightedAttributes','products','selectedProducts', 'selectedCrossProducts'));
    }

    public function storeClone(CloneRequest $request, Product $product)
    {
        $productData = $request->only(['name', 'label', 'variety_label', 'variety_value', 'slug', 'alt', 'description', 'title', 'meta_description', 'manufacturer_id', 'model', 'length', 'width', 'height', 'weight', 'length_unit', 'weight_unit', 'src', 'suggest', 'warranty', 'giftcard', 'badge', 'sort_order', 'count_star', 'price', 'stock', 'status', 'hide_price', 'is_foreign', 'is_installment', 'catalogue_name', 'twitter_title', 'twitter_description', 'canonical',]);
        $productData['is_nofollow'] = $request->input('is_nofollow', false);
        $productData['is_noindex'] = $request->input('is_noindex', false);
        $productData['is_festival'] = $request->input('is_festival', false);
        $productData['is_available'] = $request->input('is_available', false);
        $productData['required_national_id'] = $request->input('required_national_id', false);
        $productData['user_id'] = Auth::user()->id;
        $productData['special'] = null;
        $productData['discount'] = null;
        $productData['colleague_price'] = null;
        $productData['image'] = $product->image;
        $productData['manual_updated_at'] = now();
        if ($request->hasFile('image')) {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->image->storeAs('public/images/products/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension())) {
                $productData['image'] = 'storage/images/products/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }

        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/products/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $productData['og_image'] = 'storage/images/products/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }

        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/products/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $productData['twitter_image'] = 'storage/images/products/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }

        if ($request->hasFile('catalogue')) {
            $name = pathinfo($request->catalogue->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->catalogue->storeAs('public/images/products/catalogue/' . date('Y/m'), $name . '.' . $request->catalogue->extension())) {
                $productData['catalogue'] = 'storage/images/products/catalogue/' . date('Y/m') . '/' . $name . '.' . $request->catalogue->extension();
            }
        }

        if($request->input('special')) {
            $productData['special'] = $request->input('special');
            $productData['discount'] = (int) round(100 - $productData['special'] * 100 / $productData['price']);
        }
        if($request->input('colleague_price')) {
            $productData['colleague_price'] = $request->input('special');
        }

        $product = Product::create($productData);

        // Sync relations
        $product->categories()->sync($request->input('category_id'));
        $product->relatedProducts()->sync($request->input('product_id'));
        $product->crossProducts()->sync($request->input('cross_product_id'));
        $product->filters()->sync($request->input('filter_id'));

        // Set main category_id
        foreach($product->categories as $category) {
            if($category->children()->count() == 0) {
                $product->update(['category_id' => $category->id]);
                break;
            }
        }

        $attributes = [];
        if ($request->input('attribute_id')) {
            foreach ($request->input('attribute_id') as $key => $attribute) {
                if ($request->input('attribute_value.' . $key)) {
                      $attributes[$request->input('attribute_id.' . $key)] = [
                        'value' => $request->input('attribute_value.' . $key),
                        'highlight' => $request->input('attribute_highlight.' . $key) ?1: 0,
                    ];
                }
            }
        }
        $product->attributes()->sync($attributes);

        if ($request->hasfile('images')) {
            $date = date('Y/m');
            $images = [];
            foreach ($request->file('images') as $key => $file) {
                $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                if ($file->storeAs('public/images/products/' . $date, $name . '.' . $file->getClientOriginalExtension())) {
                    $image = 'storage/images/products/' . $date . '/' . $name . '.' . $file->getClientOriginalExtension();
                }
                $sort_order = ($request->input('images_sort_order.' . $key) ?? NULL);
                $alt = ($request->input('images_alt.' . $key) ?? NULL);

                $images[] = [
                    'product_id' => $product->id,
                    'image' => $image,
                    'sort_order' => $sort_order,
                    'alt' => $alt,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            ProductImages::insert($images);
        }

        foreach($product->images as $img) {
            if(in_array($img->id, $request->input('keep_images', []))) {
                $cloneProduct->images()->create([
                    'image' => $img->image,
                    'sort_order' => $img->sort_order,
                    'alt' => $img->alt,
                ]);
            }
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "محصول $product->name کلون شد."
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Add note to an order.
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function note(Request $request, Product $product)
    {
        if ($request->input('content')) {
            $noteData = $request->only(['content']);
            $noteData['user_id'] = auth()->id();
            if($request->hasfile('attachment')) {
                $date = date('Y/m');
                foreach($request->file('attachment') as $key => $attachment)
                {
                    $name = Str::random(12);
                    if($attachment->storeAs('public/images/attachments/' . $date, $name . '.' . $attachment->extension()))
                    {
                        $noteData['attachments'] = 'storage/images/attachments/' . $date . '/' . $name . '.' . $attachment->extension();
                    }
                }
            }
            $product->notes()->save(new Note($noteData));
            success("یادداشت شما برای محصول مورد نظر با موفقیت ثبت گردید.");
        }
        return redirect()->back();
    }

    public function updatePrice(Request $request, Product $product)
    {
        if ($product) {
            $log = $this->activityLogService->init('محصول', 'updated')->prepare($product, 'old');
            $productData['price'] = $request->input('price', $product->price);
            $productData['special'] = $request->input('special', $product->special);
            $productData['manual_updated_at'] = now();
            if($request->input('special')) {
                $productData['discount'] = (int) round(100 - $productData['special'] * 100 / $productData['price']);
            }
            $product->update($productData);
            $log->prepare($product)->finalize()->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function updateStock(Request $request, Product $product)
    {
        if ($product) {
            $log = $this->activityLogService->init('محصول', 'updated')->prepare($product, 'old');
            $product->update(['stock' => $request->input('stock', $product->stock), 'manual_updated_at' => now()]);
            $log->prepare($product)->finalize()->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    private function addAttributes($product)
    {
        $productAttributesIds = $product->attributes->pluck('id')->toArray();
        $newAttributesIds = [];
        foreach($product->categories as $category) {
            foreach($category->attributeGroups as $group) {
                foreach($group->attributes as $attribute) {
                    if(!in_array($attribute->id, $productAttributesIds)) {
                        $newAttributesIds[] = $attribute->id;
                    }
                }
            }
        }
        //$product->attributes()->attach($newAttributesIds);
    }
}
