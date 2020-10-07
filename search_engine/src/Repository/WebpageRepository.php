<?php

namespace App\Repository;

use App\Entity\Webpage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Webpage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Webpage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Webpage[]    findAll()
 * @method Webpage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebpageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Webpage::class);
    }

    // /**
    //  * @return Webpage[] Returns an array of Webpage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Webpage
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
