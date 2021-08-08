<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Flower;
use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Flower\Repository\FlowerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Flower|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flower|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flower[]    findAll()
 * @method Flower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlowerRepository extends ServiceEntityRepository implements FlowerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flower::class);
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
     * @param int $limit
     * @return FlowerInterface[]
     */
    public function getWithLimit(int $limit = 100): array
    {
        return $this->findBy([], null, $limit);
    }
}
