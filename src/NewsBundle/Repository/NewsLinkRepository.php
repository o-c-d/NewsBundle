<?php

namespace Ocd\NewsBundle\Repository;

use Ocd\NewsBundle\Entity\NewsLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NewsLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsLink[]    findAll()
 * @method NewsLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsLink::class);
    }

    // /**
    //  * @return NewsLink[] Returns an array of NewsLink objects
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
    public function findOneBySomeField($value): ?NewsLink
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
