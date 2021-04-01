<?php

namespace App\Repository;

use App\Entity\ResuemeExp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResuemeExp|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResuemeExp|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResuemeExp[]    findAll()
 * @method ResuemeExp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResuemeExpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResuemeExp::class);
    }

    // /**
    //  * @return ResuemeExp[] Returns an array of ResuemeExp objects
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
    public function findOneBySomeField($value): ?ResuemeExp
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
