<?php

namespace App\Repository;

use App\Entity\DetailExp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailExp|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailExp|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailExp[]    findAll()
 * @method DetailExp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailExpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailExp::class);
    }

    // /**
    //  * @return DetailExp[] Returns an array of DetailExp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailExp
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
