<?php

namespace App\Repository;

use App\Entity\Epidemie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Epidemie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Epidemie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Epidemie[]    findAll()
 * @method Epidemie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpidemieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Epidemie::class);
    }

    // /**
    //  * @return Epidemie[] Returns an array of Epidemie objects
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
    public function findOneBySomeField($value): ?Epidemie
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
