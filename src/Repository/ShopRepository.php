<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Shop;
use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Shop\Repository\ShopRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;

/**
 * @method Shop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shop[]    findAll()
 * @method Shop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopRepository extends ServiceEntityRepository implements ShopRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shop::class);
    }

    /**
     * @param ShopInterface $shop
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    public function add(ShopInterface $shop): void
    {
        $this->getEntityManager()->persist($shop);
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
     * @return ShopInterface
     * @throws SearchException
     */
    public function getById(int $id): ShopInterface
    {
        $flower = $this->find($id);
        if ($flower === null) {
            throw new SearchException(sprintf('Not found shop #id %s', $id));
        }
        return $flower;
    }

    /**
     * @param array $ids
     * @return array
     * @throws InvalidArgumentException
     */
    public function getByIds(array $ids): array
    {
        $query = $this->createQueryBuilder('s');
        $query->add('where', $query->expr()->in('s.id', ':ids'));
        $query->setParameter('ids', $ids);
        return $query->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @return ShopInterface[]
     */
    public function getWithLimit(int $limit = 100): array
    {
        return $this->findBy([], null, $limit);
    }

    public function getAllIds(): array
    {
        return $this->createQueryBuilder('Shops')
            ->select('Shops.id')
            ->getQuery()
            ->getScalarResult();
    }

    public function findByName(string $name): ?ShopInterface
    {
        return $this->findOneBy(['name' => $name]);
    }
}
