<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Repository;

use App\Model\Document\PurchaseInterface;
use Doctrine\ODM\MongoDB\MongoDBException;
use InvalidArgumentException;

interface PurchaseRepositoryInterface
{
    /**
     * @param PurchaseInterface $purchase
     * @throws InvalidArgumentException
     */
    public function add(PurchaseInterface $purchase): void;

    /**
     * @throws MongoDBException
     */
    public function save(): void;

    /**
     * @param int $shopId
     * @return PurchaseInterface[]
     */
    public function getByShopId(int $shopId): array;
}
