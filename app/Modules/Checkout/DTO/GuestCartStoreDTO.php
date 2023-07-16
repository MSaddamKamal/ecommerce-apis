<?php

declare(strict_types=1);

namespace App\Modules\Checkout\DTO;

use App\Modules\Common\DTO\BaseDTO;

class GuestCartStoreDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $cart_id;

    /**
     * @var array|null
     */
    public ?array $product_ids;

}
