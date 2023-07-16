<?php

declare(strict_types=1);

namespace App\Modules\Checkout\DTO;

use App\Modules\Common\DTO\BaseDTO;

class CartItemDestroyDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $id;
}
