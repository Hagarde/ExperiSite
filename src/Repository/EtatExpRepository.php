<?php

namespace App\Repository;

use App\Entity\EtatExp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatExp|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatExp|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatExp[]    findAll()
 * @method EtatExp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatExpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatExp::class);
    }

    // /**
    //  * @return EtatExp[] Returns an array of EtatExp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtatExp
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
