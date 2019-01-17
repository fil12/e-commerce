<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 05.01.19
 * Time: 12:53
 */

namespace App\Service\Product;


use App\Entity\Category;
use App\Exception\NotFoundEntityException;
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
        if (!$products = $category->getProducts()){
            throw new NotFoundEntityException(\sprintf('In category with slug "%s" products not found', $category->getSlug()));
        }

        return $products;
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->find($id);
    }

    public function getProductsByFilters(array $options)
    {
        $ids = [];
        foreach ($options as $id=>$optionValues ){
            $ids[] = $id;
        }
        $products = $this->productRepository->findProductsWithFilters($ids);

        return $products;
    }

    public function getAllNewProducts()
    {
        return $this->productRepository->findAllIsNew();
    }
}