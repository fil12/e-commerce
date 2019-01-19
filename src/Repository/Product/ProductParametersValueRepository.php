<?php

namespace App\Repository\Product;

use App\Entity\ProductParametersValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductParametersValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductParametersValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductParametersValue[]    findAll()
 * @method ProductParametersValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductParametersValueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductParametersValue::class);
    }

    public function getProductsByParamId(int $id)
    {
        $productParamValue = $this->createQueryBuilder('ppv')
            ->select('ppv', 'pr')
            ->join('ppv.product', 'pr')
            ->andWhere('ppv.parameter = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult();

        return $productParamValue;
    }

    // /**
    //  * @return ProductParametersValue[] Returns an array of ProductParametersValue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductParametersValue
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
