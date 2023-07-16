<?php

declare(strict_types=1);

namespace App\Modules\Analytics\Contracts;

use Illuminate\Support\Collection;
use App\Modules\Analytics\DTO\AnalyticsStoreDTO;

/**
 * @author Muhammad Saddam
 */
interface AnalyticsRepositoryContract
{
    /**
     * @param AnalyticsStoreDTO|null $dto
     * @return Collection|null
     */
    public function create(AnalyticsStoreDTO $dto = null):?Collection;
}
