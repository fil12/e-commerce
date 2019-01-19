<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 05.01.19
 * Time: 11:00.
 */

namespace App\Repository\Category;

interface CategoryRepositoryInterface
{
    public function findAllIsPublished();

    public function findAllMainIsPublished();
}
