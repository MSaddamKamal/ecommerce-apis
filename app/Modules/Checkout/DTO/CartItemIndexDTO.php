<?php

declare(strict_types=1);

namespace App\Modules\Checkout\DTO;

use App\Modules\Common\DTO\BaseDTO;

class CartItemIndexDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $cart_id;

    /**
     * @var int|null
     */
    public ?int $page;

    /**
     * @var int|null
     */
    public ?int $page_size;
}
