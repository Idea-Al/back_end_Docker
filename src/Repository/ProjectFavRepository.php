<?php

namespace App\Repository;

use App\Entity\ProjectFav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectFav|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectFav|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectFav[]    findAll()
 * @method ProjectFav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectFavRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectFav::class);
    }

    // /**
    //  * @return ProjectFav[] Returns an array of ProjectFav objects
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
    public function findOneBySomeField($value): ?ProjectFav
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
