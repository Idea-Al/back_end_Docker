<?php

namespace App\Repository;

use App\Entity\Rhythm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rhythm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rhythm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rhythm[]    findAll()
 * @method Rhythm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhythmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rhythm::class);
    }

    // /**
    //  * @return Rhythm[] Returns an array of Rhythm objects
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
    public function findOneBySomeField($value): ?Rhythm
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
