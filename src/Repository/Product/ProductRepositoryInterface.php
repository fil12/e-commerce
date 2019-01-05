<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 05.01.19
 * Time: 11:16
 */

namespace App\Repository\Product;


interface ProductRepositoryInterface
{
    public function findAllIsPublished();

    public function findAllIsNew();

}