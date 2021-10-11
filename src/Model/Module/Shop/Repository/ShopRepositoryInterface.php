<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Repository;

use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use InvalidArgumentException;

interface ShopRepositoryInterface
{
    /**
     * @param ShopInterface $shop
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    public function add(ShopInterface $shop): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(): void;

    /**
     * @param int $id
     * @return ShopInterface
     * @throws SearchException
     */
    public function getById(int $id): ShopInterface;

    /**
     * @param array $ids
     * @return array
     * @throws InvalidArgumentException
     */
    public function getByIds(array $ids): array;

    /**
     * @param int $limit
     * @return ShopInterface[]
     */
    public function getWithLimit(int $limit = 100): array;

    public function getAllIds(): array;

    public function findByName(string $name): ?ShopInterface;
}