<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Repository;

use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

interface FlowerRepositoryInterface
{
    /**
     * @param FlowerInterface $flower
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    public function add(FlowerInterface $flower): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(): void;

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

    /**
     * @param int $shopId
     * @return FlowerInterface[]
     */
    public function getByShopId(int $shopId): array;

    /**
     * @param int $shopId
     * @param string $attributeValue
     * @return FlowerInterface[]
     */
    public function getByShopIdAndAttributeValue(int $shopId, string $attributeValue): array;

    public function findByName(string $name): ?FlowerInterface;
}