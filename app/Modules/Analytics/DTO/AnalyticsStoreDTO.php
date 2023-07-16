<?php

declare(strict_types=1);

namespace App\Modules\Analytics\DTO;

use App\Modules\Common\DTO\BaseDTO;

class AnalyticsStoreDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $id;

    /**
     * @var string|null
     */
    public ?string $model;

    /**
     * @var int|null
     */
    public ?int $model_id;

    /**
     * @var string|null
     */
    public ?string $event_type;

    /**
     * @var int|null
     */
    public ?int $user_id;

    /**
     * @var string|null
     */
    public ?string $created_at;

}
