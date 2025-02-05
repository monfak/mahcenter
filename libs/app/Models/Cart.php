<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = ['user_id', 'session_id', 'address_id', 'delivery_method_id', 'total_products_price', 'shipping_cost', 'tax', 'total_price', 'first_name', 'last_name', 'name', 'mobile'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    
    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod);
    }
    
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
