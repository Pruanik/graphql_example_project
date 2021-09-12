<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Service;

use App\Model\Document\PurchaseInterface;

interface PurchaseServiceInterface
{
    /**
     * @param int $shopId
     * @return PurchaseInterface[]|array
     */
    public function findByShopId(int $shopId): array;
}
