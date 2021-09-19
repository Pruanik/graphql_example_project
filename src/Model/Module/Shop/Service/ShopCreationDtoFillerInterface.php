<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Service;

use App\Model\Module\Shop\Dto\ShopCreationDto;
use Spatie\DataTransferObject\DataTransferObjectError;

interface ShopCreationDtoFillerInterface
{
    /**
     * @param array $args
     * @return ShopCreationDto
     * @throws DataTransferObjectError
     */
    public function filling(array $args): ShopCreationDto;
}
