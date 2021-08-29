<?php

declare(strict_types=1);

namespace App\Model\Module\FlowerAttribute\Repository;

use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;

interface FlowerAttributeRepositoryInterface
{
    /**
     * @param int $id
     * @return FlowerAttributeInterface
     * @throws SearchException
     */
    public function getById(int $id): FlowerAttributeInterface;

    /**
     * @param FlowerInterface $flower
     * @return FlowerAttributeInterface[]
     * @throws SearchException
     */
    public function getByFlower(FlowerInterface $flower): array;
}