<?php

namespace App\Repository;

use App\Entity\ResultEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResultEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResultEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResultEntity[]    findAll()
 * @method ResultEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResultEntity::class);
    }

    // /**
    //  * @return ResultEntity[] Returns an array of ResultEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResultEntity
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
