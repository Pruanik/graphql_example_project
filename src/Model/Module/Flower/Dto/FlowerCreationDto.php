<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Dto;

use App\Model\Dto\BaseDto;

class FlowerCreationDto extends BaseDto
{
    public ?string $name;
}
