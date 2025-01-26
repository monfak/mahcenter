<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Product;

class WishlistController extends Controller
{
    /**
     * Adds an specific product to the cart
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request, $id)
    {
        abort_unless($request->ajax(), 404);
        $id = (int) $id;

        if (auth()->check()) {
            $user       = auth()->user();
            $product    = Product::where('status', 1)->where('id', $id)->get()->first();
            if ($product)
            {
                $user->wishlist()->sync($product->id, false);
                $message = [
                    'status'            => 'success',
                    'body'              => "محصول با موفقیت به علاقه‌مندی‌ها شما اضافه گردید.",
                    'itemsInWishlist'   => auth()->check() ? auth()->user()->wishlist->count() : 0
                ];
            }
            else
            {
                $message = [
                    'status'    => 'danger',
                    'body'      => "محصول مورد نظر شما وجود ندارد."
                ];
            }
        } else {
            $message = [
                'status' => 'danger',
                'body' => "برای افزودن محصول به علاقه‌مندی‌ها، ابتدا باید در سایت عضو یا وارد شوید."
            ];
        }

        return response()->json($message);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $products = [];

        if (auth()->check())
        {
            $user       = auth()->user();
            $products   = $user->wishlist;
        }

        return view('frontend.wishlist', compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id product id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if (auth()->check()) {
            $user   = auth()->user();
            $user->wishlist()->detach($id);
            session()->flash('msg', [
                'status' => 'success',
                'title' => '',
                'message' => "  علاقه‌مندی‌ها بروزرسانی گردید. "
            ]);
        } else {
            session()->flash('msg', [
                'status' => 'danger',
                'title' => '',
                'message' => " برای ثبت تغییرات باید در سایت لاگین کنید. "
            ]);
        }


        return redirect()->route('wishlist');
    }

      public function toggleNotification(Request $request, $id)
    {
        abort_unless($request->ajax(), 404);
        $id = (int) $id;

        if (auth()->check()) {
            $user       = auth()->user();
            $product    = Product::where('status', 1)->where('id', $id)->get()->first();

            if ($product)
            {
                if($user->notifications()->where('product_id', $id)->first())
                    $user->notifications()->detach($id);
                else
                    $user->wishlist()->attach($id, ['is_notification' => true]);
                $message = [
                    'status'            => 'success',
                    'body'              => "با موفقیت انجام شد.",
                ];
            }
            else
            {
                $message = [
                    'status'    => 'danger',
                    'body'      => "محصول مورد نظر شما وجود ندارد."
                ];
            }
        } else {
            $message = [
                'status' => 'danger',
                'body' => "ابتدا باید در سایت عضو شوید."
            ];
        }

        return response()->json($message);
    }

}
