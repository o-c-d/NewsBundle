<?php

namespace Ocd\NewsBundle\Repository;

use Ocd\NewsBundle\Entity\NewsTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NewsTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsTag[]    findAll()
 * @method NewsTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsTag::class);
    }

    // /**
    //  * @return NewsTag[] Returns an array of NewsTag objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsTag
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
