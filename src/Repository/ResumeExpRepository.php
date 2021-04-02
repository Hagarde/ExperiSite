<?php

namespace App\Repository;

use App\Entity\ResumeExp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResumeExp|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResumeExp|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResumeExp[]    findAll()
 * @method ResumeExp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResumeExpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResumeExp::class);
    }

    // /**
    //  * @return ResumeExp[] Returns an array of ResumeExp objects
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
    public function findOneBySomeField($value): ?ResumeExp
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
