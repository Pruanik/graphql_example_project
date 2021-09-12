<?php

declare(strict_types=1);

namespace App\Repository;

use App\Document\Purchase;
use App\Model\Document\PurchaseInterface;
use App\Model\Module\Purchase\Repository\PurchaseRepositoryInterface;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use LogicException;

class PurchaseRepository extends ServiceDocumentRepository implements
    PurchaseRepositoryInterface
{
    /**
     * PurchaseRepository constructor.
     * @param ManagerRegistry $registry
     * @throws LogicException
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Purchase::class);
    }

    /**
     * @param int $shopId
     * @return PurchaseInterface[]
     */
    public function getByShopId(int $shopId): array
    {
        return $this->findBy(['shopId' => $shopId]);
    }
}
