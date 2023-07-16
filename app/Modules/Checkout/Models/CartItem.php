<?php

namespace App\Modules\Checkout\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\Cart;

class CartItem extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['product_id','cart_id','quantity'];

    /**
     * Get the user that owns the phone.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user that owns the phone.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
