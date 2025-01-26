<?php

namespace App\Http\Controllers\Admin;

use App\Models\InstallmentMonth;
use App\Models\InstallmentPercent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\InstallmentMonthRequest;
use App\Http\Requests\InstallmentPercentRequest;

class SettingController extends Controller
{
    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:settings-general')->only(['index', 'update']);
        $this->middleware('permission:settings-socials')->only(['socialsIndex', 'socialsUpdate']);
        $this->middleware('permission:settings-seo')->only(['seoIndex', 'seoUpdate']);
        $this->middleware('permission:installments-settings')->only(['installmentIndex', 'installmentUpdate', 'installmentCreate', 'installmentDelete']);
        $this->middleware('permission:installments-month')->only(['installmentMonthIndex', 'installmentMonthStore']);
        $this->middleware('permission:installments-percent')->only(['installmentPercentIndex', 'installmentPercentCreate', 'installmentPercentStore', 'installmentPercentDelete']);
        $this->middleware('permission:b2b-settings')->only(['b2bIndex', 'b2bUpdate']);
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index' , compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        Setting::where('key', 'name')->update(['value' => $request->input('name')]);
        Setting::where('key', 'slang')->update(['value' => $request->input('slang')]);
        Setting::where('key', 'copyright')->update(['value' => $request->input('copyright')]);
        Setting::where('key', 'address')->update(['value' => $request->input('address')]);
        Setting::where('key', 'mobile')->update(['value' => $request->input('mobile')]);
        Setting::where('key', 'tel')->update(['value' => $request->input('tel')]);
        Setting::where('key', 'tel-2')->update(['value' => $request->input('tel-2')]);
        Setting::where('key', 'email')->update(['value' => $request->input('email')]);
        Setting::where('key', 'response-time')->update(['value' => $request->input('response-time')]);
        Setting::where('key', 'special_started_at')->update(['value' => $request->input('special_started_at')]);
        Setting::where('key', 'special_ended_at')->update(['value' => $request->input('special_ended_at')]);
        Setting::where('key', 'app_bazaar')->update(['value' => $request->input('app_bazaar')]);
        Setting::where('key', 'app_store')->update(['value' => $request->input('app_store')]);
        Setting::where('key', 'footer_heading')->update(['value' => $request->input('footer_heading')]);
        Setting::where('key', 'footer_content')->update(['value' => $request->input('footer_content')]);
        Setting::where('key', 'scripts')->update(['value' => $request->input('scripts')]);
        success('تنظیمات آپدیت شدند.');
        return redirect()->route('admin.settings.index');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function socialsIndex()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.socials' , compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function socialsUpdate(Request $request)
    {
        Setting::where('key', 'youtube')->update(['value' => $request->input('youtube')]);
        Setting::where('key', 'instagram')->update(['value' => $request->input('instagram')]);
        Setting::where('key', 'twitter')->update(['value' => $request->input('twitter')]);
        Setting::where('key', 'facebook')->update(['value' => $request->input('facebook')]);
        Setting::where('key', 'aparat')->update(['value' => $request->input('aparat')]);
        Setting::where('key', 'telegram')->update(['value' => $request->input('telegram')]);
        Setting::where('key', 'whatsapp')->update(['value' => $request->input('whatsapp')]);
        success('تنظیمات آپدیت شدند.');
        return redirect()->route('admin.settings.socials.index');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function seoIndex()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.seo' , compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function seoUpdate(Request $request)
    {
        Setting::where('key', 'title')->update(['value' => $request->input('title')]);
        Setting::where('key', 'heading')->update(['value' => $request->input('heading')]);
        Setting::where('key', 'description')->update(['value' => $request->input('description')]);

        Setting::where('key', 'blog_title')->update(['value' => $request->input('blog_title')]);
        Setting::where('key', 'blog_heading')->update(['value' => $request->input('blog_heading')]);
        Setting::where('key', 'blog_description')->update(['value' => $request->input('blog_description')]);

        Setting::where('key', 'faq_title')->update(['value' => $request->input('faq_title')]);
        Setting::where('key', 'faq_heading')->update(['value' => $request->input('faq_heading')]);
        Setting::where('key', 'faq_description')->update(['value' => $request->input('faq_description')]);
        
        Setting::where('key', 'products_title')->update(['value' => $request->input('products_title')]);
        Setting::where('key', 'products_heading')->update(['value' => $request->input('products_heading')]);
        Setting::where('key', 'products_description')->update(['value' => $request->input('products_description')]);

        Setting::where('key', 'installment_title')->update(['value' => $request->input('installment_title')]);
        Setting::where('key', 'installment_heading')->update(['value' => $request->input('installment_heading')]);
        Setting::where('key', 'installment_description')->update(['value' => $request->input('installment_description')]);

        Setting::where('key', 'b2b_title')->update(['value' => $request->input('b2b_title')]);
        Setting::where('key', 'b2b_heading')->update(['value' => $request->input('b2b_heading')]);
        Setting::where('key', 'b2b_description')->update(['value' => $request->input('b2b_description')]);
        
        Setting::where('key', 'amazing_title')->update(['value' => $request->input('amazing_title')]);
        Setting::where('key', 'amazing_heading')->update(['value' => $request->input('amazing_heading')]);
        Setting::where('key', 'amazing_description')->update(['value' => $request->input('amazing_description')]);
        
        success('تنظیمات آپدیت شدند.');
        return redirect()->route('admin.settings.seo.index');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function festivalIndex()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.festival' , compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function festivalUpdate(Request $request)
    {
        Setting::where('key', 'is_festival_active')->update(['value' => (bool) $request->input('is_festival_active', false)]);
        Setting::where('key', 'festival_heading')->update(['value' => $request->input('festival_heading')]);
        if ($request->hasFile('festival_home_image')) {
            $name = pathinfo($request->festival_home_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->festival_home_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->festival_home_image->getClientOriginalExtension())) {
                $festival_home_image = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->festival_home_image->getClientOriginalExtension();
                Setting::where('key', 'festival_home_image')->update(['value' => $festival_home_image]);
            }
        }
        if ($request->hasFile('festival_home_title_image')) {
            $name = pathinfo($request->festival_home_title_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->festival_home_title_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->festival_home_title_image->getClientOriginalExtension())) {
                $festival_home_title_image = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->festival_home_title_image->getClientOriginalExtension();
                Setting::where('key', 'festival_home_title_image')->update(['value' => $festival_home_title_image]);
            }
        }
        Setting::where('key', 'festival_ended_at')->update(['value' => $request->input('festival_ended_at')]);
        Setting::where('key', 'deactive_festival_automatically')->update(['value' => (bool) $request->input('deactive_festival_automatically', false)]);
        Setting::where('key', 'festival_color')->update(['value' => $request->input('festival_color')]);
        Setting::where('key', 'festival_complementary_color')->update(['value' => $request->input('festival_complementary_color')]);
        Setting::where('key', 'show_festival_box')->update(['value' => (bool) $request->input('show_festival_box', false)]);
        Setting::where('key', 'festival_title')->update(['value' => $request->input('festival_title')]);
        Setting::where('key', 'festival_badge_heading')->update(['value' => $request->input('festival_badge_heading')]);
        success('تنظیمات آپدیت شدند.');
        return redirect()->route('admin.settings.festival.index');
    }

    /**
     * Display a listing of the resource.
     * @param installmentMonth $installmentMonth
     * @return Response
     */
    public function installmentIndex()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.installment' , compact('settings'));
    }

    /**
     * Display a listing of the resource.
     * @param InstallmentMonth $installmentMonth
     * @return Response
     */
    public function installmentMonthIndex(InstallmentMonth $installmentMonth)
    {
        $months = $installmentMonth->orderBy('month', 'asc')->paginate();
        return view('admin.installmentMonth.index' , compact('months'));
    }

    public function installmentPercentIndex(InstallmentPercent $installmentPercent)
    {
        $percents = $installmentPercent->orderBy('percent', 'asc')->paginate();
        return view('admin.installmentPercent.index' , compact('percents'));
    }


    public function installmentCreate()
    {
        return view('admin.installmentMonth.create');
    }

    public function installmentPercentCreate()
    {
        return view('admin.installmentPercent.create');
    }

    public function installmentMonthStore(InstallmentMonthRequest $request)
    {
        InstallmentMonth::query()->create([
            'month'=>$request['month'],
            'is_active'=>$request['is_active']
        ]);
        return redirect()->route('admin.settings.installment.month.index');

    }
    public function installmentPercentStore(InstallmentPercentRequest $request)
    {
        InstallmentPercent::query()->create([
            'percent'=>$request['percent'],
            'is_active'=>$request['is_active']
        ]);
        return redirect()->route('admin.settings.installment.percent.index');

    }

    public function installmentDelete($id)
    {
        InstallmentMonth::query()->where('id',$id)->delete();
        return redirect()->back();
    }

    public function installmentPercentDelete($id)
    {
        InstallmentPercent::query()->where('id',$id)->delete();
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function installmentUpdate(Request $request)
    {
        Setting::where('key', 'installment_heading')->update(['value' => $request->input('installment_heading')]);
        Setting::where('key', 'installment_subheading')->update(['value' => $request->input('installment_subheading')]);
        Setting::where('key', 'installment_secondheading')->update(['value' => $request->input('installment_secondheading')]);
        if ($request->hasFile('image')) {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension())) {
                $image = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
                Setting::where('key', 'installment_image')->update(['value' => $image]);
            }
        }
        Setting::where('key', 'installment_products_heading')->update(['value' => $request->input('installment_products_heading')]);
        Setting::where('key', 'installment_content')->update(['value' => $request->input('installment_content')]);
        Setting::where('key', 'installment_calculation_heading')->update(['value' => $request->input('installment_calculation_heading')]);
        Setting::where('key', 'installment_application_heading')->update(['value' => $request->input('installment_application_heading')]);
        Setting::where('key', 'installment_application_subheading')->update(['value' => $request->input('installment_application_subheading')]);
        Setting::where('key', 'installment_sidebar_content')->update(['value' => $request->input('installment_sidebar_content')]);
        Setting::where('key', 'installment_sidebar_tel')->update(['value' => $request->input('installment_sidebar_tel')]);
        success('تنظیمات آپدیت شدند.');
        return redirect()->route('admin.settings.installment.index');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function b2bIndex()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.b2b' , compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function b2bUpdate(Request $request)
    {
        success('تنظیمات آپدیت شدند.');
        return redirect()->route('admin.settings.b2b.index');
    }
}
