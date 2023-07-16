<?php

declare(strict_types=1);

namespace App\Modules\Checkout\DTO;

use App\Modules\Common\DTO\BaseDTO;

class CartDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $id;

    /**
     * @var int|null
     */
    public ?int $user_id;

    /**
     * @var string|null
     */
    public ?string $created_at;

    /**
     * @var string|null
     */
    public ?string $updated_at;

}
