<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart()
    {
        if (Auth::check()) {
            return Cart::with('items.product')->where('user_id', Auth::id())->first();
        }

        $sessionId = session()->getId();
        return Cart::with('items.product')->where('session_id', $sessionId)->first();
    }

    /**
     * Retrieves the cart or creates a new one if it doesn't exist
     */
    public function getOrCreateCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['session_id' => null]  // Ensure session_id is null for logged-in users
            );
        }

        $sessionId = session()->getId();
        return Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['user_id' => null]  // Ensure user_id is null for guest users
        );
    }

    /**
     * Retrieves the cart details for viewing (no creation)
     */
    public function getCartDetails()
    {
        $itemsInBasket = [
            'quantity' => 0,
            'products' => [],
            'totalPrice' => 0,
        ];

        // Get the active cart without creating a new one
        $cart = $this->getCart();

        if ($cart) {
            // Calculate total quantity and price
            $itemsInBasket['quantity'] = $cart->items->sum('quantity');

            foreach ($cart->items as $cartItem) {
                $product = $cartItem->product;

                // Determine price (special price if available)
                $price = $product->special ?? $cartItem->price;
                $totalPrice = $price * $cartItem->quantity;

                $itemsInBasket['products'][] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'slug' => $product->slug,
                    'model' => $product->model,
                    'price' => $price,
                    'quantity' => $cartItem->quantity,
                    'totalPrice' => $totalPrice,
                ];

                $itemsInBasket['totalPrice'] += $totalPrice;
            }
        }

        // Return the rendered view and other cart details
        $itemsInBasket['items'] = view('frontend.cart.mini-cart', compact('itemsInBasket'))->render();

        return $itemsInBasket;
    }
    
    public function addToCart($productId, $quantity, $warrantyId = null)
    {
        $cart = $this->getOrCreateCart();
        $product = Product::findOrFail($productId);

        $cartItem = $cart->items()->updateOrCreate(
            ['product_id' => $productId],
            [
                'quantity' => \DB::raw('quantity + ' . $quantity),
                'price' => $product->special ?? $product->price,
                'warranty_id' => $warrantyId,
            ]
        );
        
        $this->updateCartTotal($cart);
        
        return $cartItem;
    }
    
    
    public function updateCartTotal($cart)
    {
        $total = $cart->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    
        $cart->update(['total_price' => $total]);
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();

        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return $cart;
    }

    public function clearCart()
    {
        $cart = $this->getCart();

        $cart->items()->delete();

        return $cart;
    }
    
    public function delete($cart)
    {
        return $cart->delete();
    }
    
    public function setAddress($cart, $addressId)
    {
        return $cart->update(['address_id' => $addressId]);
    }
    
    public function getAddress($cart)
    {
        $cart->load('address');
        return $cart->address;
    }
}
