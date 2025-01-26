<?php

namespace App\Http\Views\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use App\Services\CartService;

class ItemInBasketsComposer
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    
    public function compose(View $view)
    {
        $itemsInBasket = $this->cartService->getCartDetails();
        $view->with('itemsInBasket', $itemsInBasket);
    }
}
