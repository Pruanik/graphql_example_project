<?php

namespace App\Repository;

use App\Entity\FlowerAttribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FlowerAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlowerAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlowerAttribute[]    findAll()
 * @method FlowerAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlowerAttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlowerAttribute::class);
    }

    // /**
    //  * @return FlowerAttribute[] Returns an array of FlowerAttribute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FlowerAttribute
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
