<?php

declare(strict_types=1);

namespace App\Model\Module\Attribute\Repository;

use App\Model\Entity\AttributeInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

interface AttributeRepositoryInterface
{
    /**
     * @param AttributeInterface $attribute
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    public function add(AttributeInterface $attribute): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(): void;

    public function findByName(string $name): ?AttributeInterface;
}
