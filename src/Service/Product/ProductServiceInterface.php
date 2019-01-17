<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 05.01.19
 * Time: 12:51
 */

namespace App\Service\Product;


use App\Entity\Category;

interface ProductServiceInterface
{
    public function getAllProductsIsPublished();

    public function getCategoryProducts(Category $category);

    public function getProductById(int $id);

    public function getProductsByFilters(array $options);

    public function getAllNewProducts();
}