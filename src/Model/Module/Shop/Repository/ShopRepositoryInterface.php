<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Repository;

use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;

interface ShopRepositoryInterface
{
    /**
     * @param int $id
     * @return ShopInterface
     * @throws SearchException
     */
    public function getById(int $id): ShopInterface;

    /**
     * @param int $limit
     * @return ShopInterface[]
     */
    public function getWithLimit(int $limit = 100): array;
}