<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 05.01.19
 * Time: 10:51
 */

namespace App\Service\Category;

use App\Entity\Category;

interface CategoryServiceInterface
{
    public function getCategoryBySlug(string $slug);

    public function getAllCategories();

}