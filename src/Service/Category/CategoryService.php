<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 05.01.19
 * Time: 10:54
 */

namespace App\Service\Category;

use App\Exception\NotFoundEntityException;
use App\Entity\Category;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Product\ProductRepository;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;
    protected $productRepository;

    /**
     * CategoryService constructor.
     * @param $categoryRepository
     * @param $productRepository
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepository $productRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }


    public function getCategoryBySlug(string $slug)
    {
        if (!$category = $this->categoryRepository->findOneBy(['slug'=>$slug])){
            throw new NotFoundEntityException(\sprintf('Category with slug "%s" not found', $slug));
        }
        return $category;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->findAllIsPublished();
    }


    public function getAllMainCategories() {
        if (!$categories = $this->categoryRepository->findAllMainIsPublished()){
            throw new NotFoundEntityException(\sprintf('Categories are not found'));
        }
        return $categories;
    }

}