<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Flower;
use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Flower\Repository\FlowerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use LogicException;

/**
 * @method Flower|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flower|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flower[]    findAll()
 * @method Flower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlowerRepository extends ServiceEntityRepository implements FlowerRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     * @throws LogicException
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flower::class);
    }

    /**
     * @param FlowerInterface $flower
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    public function add(FlowerInterface $flower): void
    {
        $this->getEntityManager()->persist($flower);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $id
     * @return FlowerInterface
     * @throws SearchException
     */
    public function getById(int $id): FlowerInterface
    {
        $flower = $this->find($id);
        if ($flower === null) {
            throw new SearchException(sprintf('Not found flower #id %s', $id));
        }
        return $flower;
    }

    /**
     * @param int[] $ids
     * @return FlowerInterface[]
     * @throws InvalidArgumentException
     */
    public function getByIds(array $ids): array
    {
        $query = $this->createQueryBuilder('f');
        $query->add('where', $query->expr()->in('s.id', ':ids'));
        $query->setParameter('ids', $ids);
        return $query->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @return FlowerInterface[]
     */
    public function getWithLimit(int $limit = 100): array
    {
        return $this->findBy([], null, $limit);
    }

    /**
     * @param int $shopId
     * @return FlowerInterface[]
     */
    public function getByShopId(int $shopId): array
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.shops', 's', 'WITH', 's.id = :shopId')
            ->setParameter(':shopId', $shopId)
            ->getQuery()->getResult();
    }

    /**
     * @param int $shopId
     * @param string $attributeValue
     * @return FlowerInterface[]
     */
    public function getByShopIdAndAttributeValue(int $shopId, string $attributeValue): array
    {
        return $this->createQueryBuilder('f')
            ->leftJoin('f.flowerAttributes', 'fa')
            ->innerJoin('f.shops', 's', 'WITH', 's.id = :shopId')
            ->where('fa.value = :value')
            ->setParameter(':value', $attributeValue)
            ->setParameter(':shopId', $shopId)
            ->getQuery()->getResult();
    }

    public function findByName(string $name): ?FlowerInterface
    {
        return $this->findOneBy(['name' => $name]);
    }
}
