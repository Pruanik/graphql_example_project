<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Dto;

use App\Model\Dto\BaseDto;

class PurchaseCreationDto extends BaseDto
{
    public ?string $customerName;
}
