<?php

declare(strict_types=1);

namespace App\Modules\Checkout\DTO;

use App\Modules\Common\DTO\BaseDTO;

class CartItemStoreDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $cart_id;

    /**
     * @var int|null
     */
    public ?int $product_id;

    /**
     * @var int|null
     */
    public ?int $quantity;
}
