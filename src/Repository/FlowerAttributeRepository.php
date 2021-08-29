<?php

namespace App\Repository;

use App\Entity\FlowerAttribute;
use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\FlowerAttribute\Repository\FlowerAttributeRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FlowerAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlowerAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlowerAttribute[]    findAll()
 * @method FlowerAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlowerAttributeRepository extends ServiceEntityRepository implements FlowerAttributeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlowerAttribute::class);
    }

    public function getById(int $id): FlowerAttributeInterface
    {
        $flowerAttribute = $this->find($id);
        if ($flowerAttribute === null) {
            throw new SearchException(sprintf('Not found flower attribute #id %s', $id));
        }
        return $flowerAttribute;
    }

    /**
     * @param FlowerInterface $flower
     * @return FlowerAttributeInterface[]
     * @throws SearchException
     */
    public function getByFlower(FlowerInterface $flower): array
    {
        $flowerAttribute = $this->findBy(['flower' => $flower]);
        if ($flowerAttribute === null) {
            throw new SearchException(sprintf('Not found flower attribute for flower #id %s', $flower->getId()));
        }
        return $flowerAttribute;
    }
}
