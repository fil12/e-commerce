<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 09.01.19
 * Time: 10:14
 */

namespace App\Service\Product;


use App\Exception\NotFoundEntityException;
use App\Repository\Product\ParametersRepositoryInterface;

class ParametersService implements ParametersServiceInterface
{
    public $parametersRepository;

    public function __construct(ParametersRepositoryInterface $parametersRepository)
    {
        $this->parametersRepository = $parametersRepository;
    }

    public function getAllProductsParameters()
    {
        if (!$allParameters = $this->parametersRepository->findMainParams()){
            throw new NotFoundEntityException('Parameters not found');
        }

        return $allParameters;
    }
}