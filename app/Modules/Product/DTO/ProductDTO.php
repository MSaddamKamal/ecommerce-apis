<?php

declare(strict_types=1);

namespace App\Modules\Product\DTO;

use App\Modules\Common\DTO\BaseDTO;

class ProductDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $id;

    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var string|null
     */
    public ?string $sku;

    /**
     * @var string|null
     */
    public ?string $image_url;

    /**
     * @var int|null
     */
    public ?int $price;

    /**
     * @var int|null
     */
    public ?int $quantity;

    /**
     * @var string|null
     */
    public ?string $created_at;

    /**
     * @var string|null
     */
    public ?string $updated_at;


}
