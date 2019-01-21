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
}
