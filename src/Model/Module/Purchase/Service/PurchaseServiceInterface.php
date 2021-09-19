<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Service;

use App\Model\Document\PurchaseInterface;
use App\Model\Entity\ShopInterface;
use App\Model\Module\Purchase\Dto\PurchaseCreationDto;
use Doctrine\ODM\MongoDB\MongoDBException;
use InvalidArgumentException;

interface PurchaseServiceInterface
{
    /**
     * @param int $shopId
     * @return PurchaseInterface[]|array
     */
    public function findByShopId(int $shopId): array;

    /**
     * @param PurchaseCreationDto $purchaseDto
     * @param ShopInterface $shop
     * @return PurchaseInterface
     * @throws MongoDBException
     * @throws InvalidArgumentException
     */
    public function create(PurchaseCreationDto $purchaseDto, ShopInterface $shop): PurchaseInterface;
}
