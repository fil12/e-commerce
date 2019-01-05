<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 05.01.19
 * Time: 12:53
 */

namespace App\Service\Product;


use App\Entity\Category;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Product\ProductRepositoryInterface;
use phpDocumentor\Reflection\Types\Integer;

class ProductService implements ProductServiceInterface
{

    protected $productRepository;

    protected $categoryRepository;

    /**
     * ProductService constructor.
     * @param $productRepository
     * @param $categoryRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllProductsIsPublished()
    {
        return $this->productRepository->findAllIsPublished();
    }

    public function getCategoryProducts(Category $category)
    {
        $products = $category->getProducts();
        return $products;
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->find($id);
    }
}