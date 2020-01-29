<?php

namespace Ocd\NewsBundle\Repository;

use Ocd\NewsBundle\Entity\News;
use Ocd\NewsBundle\Entity\NewsTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Doctrine\ORM\Query;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function findLatest(int $limitPerPage=News::NUM_ITEMS, int $page = 1, array $tags = []): Pagerfanta
    {
        $qb = $this->createQueryBuilder('news')
            ->addSelect('tags')
            ->leftJoin('news.tags', 'tags')
            ->where('news.publishedAt <= :now')
            ->orderBy('news.publishedAt', 'DESC')
            ->setParameter('now', new \DateTime());

        if (false === empty($tags)) {
            foreach ($tags as $tag) {
                if($tag instanceof NewsTag)
                {
                $qb->andWhere(':tag MEMBER OF news.tags')
                    ->setParameter('tag', $tag);
                }
            }
        }

        return $this->createPaginator($qb->getQuery(), $limitPerPage, $page);
    }

    private function createPaginator(Query $query, int $limitPerPage, int $page): Pagerfanta
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage($limitPerPage);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    // /**
    //  * @return News[] Returns an array of News objects
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
    public function findOneBySomeField($value): ?News
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
