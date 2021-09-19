<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Service;

use App\Document\Purchase;
use App\Model\Document\PurchaseInterface;
use App\Model\Entity\ShopInterface;
use App\Model\Module\Purchase\Dto\PurchaseCreationDto;
use App\Model\Module\Purchase\Repository\PurchaseRepositoryInterface;
use Doctrine\ODM\MongoDB\MongoDBException;
use InvalidArgumentException;

class PurchaseService implements PurchaseServiceInterface
{
    private PurchaseRepositoryInterface $purchaseRepository;

    public function __construct(PurchaseRepositoryInterface $purchaseRepository)
    {
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

    /**
     * @param PurchaseCreationDto $purchaseDto
     * @param ShopInterface $shop
     * @return PurchaseInterface
     * @throws MongoDBException
     * @throws InvalidArgumentException
     */
    public function create(PurchaseCreationDto $purchaseDto, ShopInterface $shop): PurchaseInterface
    {
        $purchase = new Purchase();
        $purchase->setCustomerName($purchaseDto->customerName);
        $purchase->setShopId($shop->getId());

        $this->purchaseRepository->add($purchase);
        $this->purchaseRepository->save();

        return $purchase;
    }
}