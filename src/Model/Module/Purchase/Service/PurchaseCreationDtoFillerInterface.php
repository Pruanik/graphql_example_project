<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Service;

use App\Model\Module\Purchase\Dto\PurchaseCreationDto;
use Spatie\DataTransferObject\DataTransferObjectError;

interface PurchaseCreationDtoFillerInterface
{
    /**
     * @param array $args
     * @return PurchaseCreationDto
     * @throws DataTransferObjectError
     */
    public function filling(array $args): PurchaseCreationDto;
}
