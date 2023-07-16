<?php

namespace App\Modules\Checkout\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Checkout\Models\CartItem;

class Cart extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['user_id'];

    /**
     * Get the user that owns the phone.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
