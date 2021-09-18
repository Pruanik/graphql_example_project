<?php

declare(strict_types=1);

namespace App\Model\Module\FlowerAttribute\Repository;

use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

interface FlowerAttributeRepositoryInterface
{
    /**
     * @param FlowerAttributeInterface $flower
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    public function add(FlowerAttributeInterface $flower): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(): void;

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