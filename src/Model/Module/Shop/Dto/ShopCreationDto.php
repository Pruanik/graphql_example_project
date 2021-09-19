<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Dto;

use App\Model\Dto\BaseDto;
use App\Model\Module\Flower\Dto\FlowerCreationDto;
use App\Model\Module\Purchase\Dto\PurchaseCreationDto;

class ShopCreationDto extends BaseDto
{
    public ?string $name;

    public ?string $address;

    /**
     * @var FlowerCreationDto[]|array|null
     */
    public ?array $flowers;

    /**
     * @var PurchaseCreationDto[]|array|null
     */
    public ?array $purchases;
}
