<?php

namespace App\Repository\Product;

use App\Entity\Parameters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Parameters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parameters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parameters[]    findAll()
 * @method Parameters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParametersRepository extends ServiceEntityRepository implements ParametersRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Parameters::class);
    }

    public function findMainParams()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.parent is null')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
