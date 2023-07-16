<?php

declare(strict_types=1);

namespace App\Modules\Checkout\DTO;

use App\Modules\Common\DTO\BaseDTO;

class CartItemMultipleDTO extends BaseDTO
{
    /**
     * @var array|null
     */
    public ?array $cartItemDTO;
}
