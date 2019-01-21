<?php

namespace App\Repository\Product;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return Product[] Returns an array of Product objects is published
     */
    public function findAllIsPublished(int $limit)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.is_published = true')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Product[] Returns an array of Product objects is published and created_at > than week ago
     */
    public function findAllIsNew()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.created_at >= (CURRENT_DATE() - 7)')
            ->andWhere('p.is_published = true')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Product[] Returns an array of Product objects is published and created_at > than week ago
     */
    public function findAllIsRecommended()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.is_recommended = true')
            ->andWhere('p.is_published = true')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findProductsWithFilters($params)
    {
        $count = count($params);

        return $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.productParametersValues', 'ppv')
            ->andWhere('ppv.parameter in (:values)')
            ->groupBy('p')
            ->andHaving('count(ppv) >= :count')
            ->setParameter('values', $params, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
            ->setParameter('count', $count)
            ->getQuery()
            ->getResult()
            ;
    }

    public function searchProducts(string $search_str)
    {
        return $this->createQueryBuilder('p')
            ->where('p.title like :search_str')
            ->orderBy('p.id', 'ASC')
            ->setParameters([':search_str' => '%'.$search_str.'%'])
            ->getQuery()
            ->getResult()
            ;
    }
}
