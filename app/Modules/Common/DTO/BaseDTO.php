<?php

declare(strict_types=1);

namespace App\Modules\Common\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class BaseDTO extends DataTransferObject
{
    /**
     * @var int|null
     */
    public ?int $user_id;

    /**
     * @var bool|null
     */
    public ?bool $pagination;

    /**
     * @var int|null
     */
    public ?int $page;

    /**
     * @var int|null
     */
    public ?int $per_page;

    /**
     * @return $this
     */
    public function withAuthUser(): self
    {
        if(auth()->check()){
            $this->user_id = auth()->user()?->id;
        }
        return $this;
    }
}
