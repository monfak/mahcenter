<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreNewsletterRequest;
use Newsletter;

class NewsletterController extends Controller
{
    /**
     * NewsletterController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:newsletter-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $newsletter = collect(Newsletter::getMembers());
        new LengthAwarePaginator($newsletter['members'], $newsletter['total_items'], 2, $request->page ?? 1);
//        dd($newsletter->forPage($_GET['page'] ?? 1, 2));
        return view()->first(['admin.newsletter.index', 'newsletter::index'], compact('newsletter'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view()->first(['admin.newsletter.create', 'newsletter::create']);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreNewsletterRequest $request
     * @return Response
     */
    public function store(StoreNewsletterRequest $request)
    {
        $params = [];
        if ($request->first_name) {
            $params['firstName'] = $request->first_name;
        }
        if ($request->last_name) {
            $params['lastName'] = $request->last_name;
        }
        Newsletter::subscribe($request->email, $params, 'subscribers');

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "کاربر مورد نظر شما با موفقیت در خبرنامه عضو شد."
        ]);

        return redirect()->route('admin.newsletter.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('newsletter::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $email
     * @return Response
     */
    public function edit($email)
    {
        abort_unless(Newsletter::hasMember($email), 404, 'کاربری با این ایمیل عضو خبرنامه نیست.');
        $member = Newsletter::getMember($email);
        return view()->first(['admin.newsletter.edit', 'newsletter::edit'], compact($member));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $email
     * @return Response
     */
    public function destroy(Request $request, $email)
    {
        Newsletter::delete($email);

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "کاربر مورد نظر شما با موفقیت از خبرنامه حذف شد."
        ]);

        return redirect()->route('admin.newsletter.index');
    }
}
