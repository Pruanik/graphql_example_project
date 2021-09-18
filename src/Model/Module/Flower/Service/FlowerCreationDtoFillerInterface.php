<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Service;

use App\Model\Module\Flower\Dto\FlowerCreationDto;
use Spatie\DataTransferObject\DataTransferObjectError;

interface FlowerCreationDtoFillerInterface
{
    /**
     * @param array $args
     * @return FlowerCreationDto
     * @throws DataTransferObjectError
     */
    public function filling(array $args): FlowerCreationDto;
}
