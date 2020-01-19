<?php

namespace Ocd\NewsBundle\Repository;

use Ocd\NewsBundle\Entity\NewsAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NewsAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsAttachment[]    findAll()
 * @method NewsAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsAttachment::class);
    }

    // /**
    //  * @return NewsAttachment[] Returns an array of NewsAttachment objects
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
    public function findOneBySomeField($value): ?NewsAttachment
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
