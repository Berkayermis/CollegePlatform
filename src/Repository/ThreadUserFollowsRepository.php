<?php

namespace App\Repository;

use App\Entity\ThreadUserFollows;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThreadUserFollows|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThreadUserFollows|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThreadUserFollows[]    findAll()
 * @method ThreadUserFollows[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThreadUserFollowsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThreadUserFollows::class);
    }

    // /**
    //  * @return ThreadUserFollows[] Returns an array of ThreadUserFollows objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ThreadUserFollows
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
