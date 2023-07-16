<?php

declare(strict_types=1);

namespace App\Modules\Product\DTO;

use App\Modules\Common\DTO\BaseDTO;

class ProductIndexDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $cart_id;

    /**
     * @var bool|null
     */
    public ?bool $pagination;
}
