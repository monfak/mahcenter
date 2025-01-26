<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Validator;
use Newsletter;

class NewsletterController extends Controller
{
    /**
     * Subscribe an email to the newsletter
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function subscribe(Request $request)
    {
        abort_unless($request->ajax(), 404);

        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'required|email',
        ]);

        if($validator->fails()) {
            $message = [
                'status' => 'danger',
                'body' => "ایمیل شما معتبر نیست!"
            ];
        } else {
            if(Newsletter::hasMember($request->email)) {
                $message = [
                    'status' => 'danger',
                    'body' => "شما قبلا در خبرنامه عضو شده‌اید."
                ];
            } else {
                $params = [];
                if ($request->first_name) {
                    $params['firstName'] = $request->first_name;
                }
                if ($request->last_name) {
                    $params['lastName'] = $request->last_name;
                }
                Newsletter::subscribe($request->email, $params, 'subscribers');
                $message = [
                    'status' => 'success',
                    'body' => "ایمیل شما با موفقیت در خبرنامه ثبت گردید."
                ];
            }
        }

        return response()->json($message);
    }
}
