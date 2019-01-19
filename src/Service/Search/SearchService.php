<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 13.01.19
 * Time: 20:12.
 */

namespace App\Service\Search;

use App\Repository\Product\ProductRepositoryInterface;

class SearchService implements SearchServiceInterface
{
    public $productRepositoy;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepositoy = $productRepository;
    }

    public function search(?string $string = 'default')
    {
        if (null === $string) {
            return 'please enter the query!';
        } else {
            return $this->productRepositoy->searchProducts($string);
        }
    }
}
