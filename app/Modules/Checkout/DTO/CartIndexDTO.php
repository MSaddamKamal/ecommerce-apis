<?php

declare(strict_types=1);

namespace App\Modules\Checkout\DTO;

use App\Modules\Common\DTO\BaseDTO;

class CartIndexDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $user_id;

    /**
     * @var int|null
     */
    public ?int $page;

    /**
     * @var int|null
     */
    public ?int $page_size;

}
