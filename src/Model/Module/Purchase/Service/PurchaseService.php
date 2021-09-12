<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Service;

use App\Model\Document\PurchaseInterface;
use App\Model\Module\Purchase\Repository\PurchaseRepositoryInterface;

class PurchaseService implements PurchaseServiceInterface
{
    private PurchaseRepositoryInterface $purchaseRepository;

    public function __construct(PurchaseRepositoryInterface $purchaseRepository) {
        $this->purchaseRepository = $purchaseRepository;
    }

    /**
     * @param int $shopId
     * @return PurchaseInterface[]|array
     */
    public function findByShopId(int $shopId): array
    {
        return $this->purchaseRepository->getByShopId($shopId);
    }
}