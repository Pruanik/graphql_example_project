<?php

namespace App\Repository;

use App\Entity\Attribute;
use App\Model\Entity\AttributeInterface;
use App\Model\Module\Attribute\Repository\AttributeRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use LogicException;

/**
 * @method Attribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attribute[]    findAll()
 * @method Attribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeRepository extends ServiceEntityRepository implements AttributeRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     * @throws LogicException
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attribute::class);
    }

    /**
     * @param AttributeInterface $attribute
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    public function add(AttributeInterface $attribute): void
    {
        $this->getEntityManager()->persist($attribute);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(): void
    {
        $this->getEntityManager()->flush();
    }

    public function findByName(string $name): ?AttributeInterface
    {
        return $this->findOneBy(['name' => $name]);
    }
}
