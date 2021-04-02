<?php

namespace App\Repository;

use App\Entity\ResumeExperience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResumeExperience|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResumeExperience|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResumeExperience[]    findAll()
 * @method ResumeExperience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResumeExperienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResumeExperience::class);
    }

    // /**
    //  * @return ResumeExperience[] Returns an array of ResumeExperience objects
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
    public function findOneBySomeField($value): ?ResumeExperience
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
