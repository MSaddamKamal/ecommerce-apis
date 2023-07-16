<?php

declare(strict_types=1);

namespace App\Modules\Product\Contracts;

use App\Modules\Product\DTO\ProductIndexDTO;
use Illuminate\Support\Collection;

/**
 * @author Muhammad Saddam
 */
interface ProductRepositoryContract
{
    /**
     * @param ProductIndexDTO $dto
     * @return Collection|null
     */
    public function all(ProductIndexDTO $dto): ?Collection;
}
