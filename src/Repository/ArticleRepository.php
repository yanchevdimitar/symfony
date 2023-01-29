<?php

namespace App\Repository;

use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false)
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByDate(?DateTime $date, ?int $offset, ?int $limit): array
    {
        $query = $this->createQueryBuilder('a');
        if ($date) {
            $query->andWhere('a.created_at >= :fromDate')
                ->andWhere('a.created_at <= :toDate')
                ->setParameter('fromDate', $date->modify('-1 day')->format('Y-m-d H:i:s'))
                ->setParameter('toDate', $date->modify('+2 day')->modify('-1 second')->format('Y-m-d H:i:s'));
        }

        return $query->andWhere('a.status = \'t\'')
            ->orderBy('a.created_at', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
