<?php

declare(strict_types=1);

namespace App\Modules\Checkout\Contracts;

use App\Modules\Checkout\DTO\CartItemDTO;
use Illuminate\Support\Collection;
use App\Modules\Checkout\DTO\CartItemIndexDTO;
use App\Modules\Checkout\DTO\CartItemDestroyDTO;

/**
 * @author Muhammad Saddam
 */
interface CartItemRepositoryContract
{
    /**
     * @param CartItemIndexDTO $dto
     * @return Collection|null
     */
    public function all(CartItemIndexDTO $dto): ?Collection;


    /**
     * @param CartItemDTO|null $dto
     * @return Collection|null
     */
    public function create(CartItemDTO $dto = null):?Collection;

    /**
     * @param CartItemDTO|null $dto
     * @return Collection|null
     */
    public function update(CartItemDTO $dto = null): ?Collection;

    /**
     * @param CartItemDestroyDTO $dto
     * @return Collection|null
     */
    public function delete(CartItemDestroyDTO $dto): ?Collection;
}
