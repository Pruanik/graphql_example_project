<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Repository;

use App\Model\Document\PurchaseInterface;

interface PurchaseRepositoryInterface
{
    /**
     * @param int $shopId
     * @return PurchaseInterface[]
     */
    public function getByShopId(int $shopId): array;
}
