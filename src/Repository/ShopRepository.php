<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Shop;
use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Shop\Repository\ShopRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
     * @param int $limit
     * @return ShopInterface[]
     */
    public function getWithLimit(int $limit = 100): array
    {
        return $this->findBy([], null, $limit);
    }
}
