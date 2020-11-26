<?php

namespace App\Repository;

use App\Entity\Learning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Learning|null find($id, $lockMode = null, $lockVersion = null)
 * @method Learning|null findOneBy(array $criteria, array $orderBy = null)
 * @method Learning[]    findAll()
 * @method Learning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LearningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Learning::class);
    }

    // /**
    //  * @return Learning[] Returns an array of Learning objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Learning
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
