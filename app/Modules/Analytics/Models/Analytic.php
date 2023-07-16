<?php

namespace App\Modules\Analytics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Auth\Models\User;
use App\Modules\Product\Models\Product;
use App\Modules\Analytics\Events\ItemAdded;
use App\Modules\Analytics\Events\ItemPurchased;
use App\Modules\Analytics\Events\ItemViewed;
use App\Modules\Analytics\Events\UserRegistered;

class Analytic extends Model
{
    use HasFactory;

    public const EVENT_TYPE = [
        'item_viewed' => Product::class,
        'item_added' => Product::class,
        'item_purchased' => Product::class,
        'user_registered' => User::class
    ];

    public const ACTIONS_EVENT = [
        'item_viewed' => ItemViewed::class,
        'item_added' => ItemAdded::class,
        'item_purchased' => ItemPurchased::class,
        'user_registered' => UserRegistered::class
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
