<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 13.01.19
 * Time: 20:12
 */

namespace App\Service\Search;


use App\Exception\NoContentException;
use App\Repository\Product\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Tests\CacheWarmer\testRouterInterfaceWithoutWarmebleInterface;

class SearchService implements SearchServiceInterface
{

    public $productRepositoy;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepositoy = $productRepository;
    }

    public function search(?string $string = "default")
    {

        if ($string === null){
            return 'please enter the query!';
        }else{
            return $this->productRepositoy->searchProducts($string);
        }

    }
}