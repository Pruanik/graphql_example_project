<?php

declare(strict_types=1);

namespace App\Repository;

use App\Document\Purchase;
use App\Model\Module\Purchase\Repository\PurchaseRepositoryInterface;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use Doctrine\ODM\MongoDB\MongoDBException;
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
     * @throws MongoDBException
     */
    public function deleteAll(): void
    {
        $this->createQueryBuilder()->remove()
            ->getQuery()
            ->execute();
    }
}
