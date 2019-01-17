<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 15.01.19
 * Time: 10:50
 */

namespace App\Service\Cart;


use App\Entity\Product;

interface CartServiceInterface
{
    public function addToCart(Product $product);

    public function getCart();

    public function deleteProductFromCart(Product $product);

    public function cleanCart();

}