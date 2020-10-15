<?php

namespace App\Repository;

use App\Entity\ThreadUserFollow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThreadUserFollow|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThreadUserFollow|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThreadUserFollow[]    findAll()
 * @method ThreadUserFollow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThreadUserFollowsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThreadUserFollow::class);
    }

    // /**
    //  * @return ThreadUserFollow[] Returns an array of ThreadUserFollow objects
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
    public function findOneBySomeField($value): ?ThreadUserFollow
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
