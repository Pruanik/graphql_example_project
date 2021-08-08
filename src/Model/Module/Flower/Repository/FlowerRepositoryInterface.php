<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Repository;

use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;

interface FlowerRepositoryInterface
{
    /**
     * @param int $id
     * @return FlowerInterface
     * @throws SearchException
     */
    public function getById(int $id): FlowerInterface;

    /**
     * @param int $limit
     * @return FlowerInterface[]
     */
    public function getWithLimit(int $limit = 100): array;
}