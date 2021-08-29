<?php

declare(strict_types=1);

namespace App\Model\Module\Purchase\Repository;

use Doctrine\ODM\MongoDB\MongoDBException;

interface PurchaseRepositoryInterface
{
    /**
     * @throws MongoDBException
     */
    public function deleteAll(): void;
}
