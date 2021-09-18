<?php

declare(strict_types=1);

namespace App\Model\Module\FlowerAttribute\Dto;

use App\Model\Dto\BaseDto;

class FlowerAttributeCreationDto extends BaseDto
{
    public ?string $attributeName;

    public ?string $value;
}
