<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Dto;

use App\Model\Dto\BaseDto;
use App\Model\Module\FlowerAttribute\Dto\FlowerAttributeCreationDto;

class FlowerCreationDto extends BaseDto
{
    public ?string $name;

    /**
     * @var FlowerAttributeCreationDto[]|array|null
     */
    public ?array $flowerAttributes;
}
