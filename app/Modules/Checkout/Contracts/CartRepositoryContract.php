<?php

declare(strict_types=1);

namespace App\Modules\Checkout\Contracts;


use App\Modules\Checkout\DTO\CartDTO;
use Illuminate\Support\Collection;
use App\Modules\Checkout\DTO\CartStoreDTO;
use App\Modules\Checkout\DTO\CartIndexDTO;
use App\Modules\Checkout\DTO\CartDestroyDTO;

/**
 * @author Muhammad Saddam
 */
interface CartRepositoryContract
{
    /**
     * @param CartIndexDTO $dto
     * @return Collection|null
     */
    public function all(CartIndexDTO $dto): ?Collection;

    /**
     * @param CartStoreDTO|null $dto
     * @return Collection|null
     */
    public function create(CartStoreDTO $dto = null):?Collection;

    /**
     * @param CartDTO|null $dto
     * @return Collection|null
     */
    public function update(CartDTO $dto = null): ?Collection;

    /**
     * @param CartDestroyDTO $dto
     * @return Collection|null
     */
    public function delete(CartDestroyDTO $dto): ?Collection;
}
