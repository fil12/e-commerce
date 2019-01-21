<?php

namespace App\Repository\Product;

use App\Entity\ProductImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductImages[]    findAll()
 * @method ProductImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductImagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductImages::class);
    }
}
