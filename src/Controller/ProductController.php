<?php

namespace App\Controller;

use App\Service\Product\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/category/{slug}/{id}", name="product")
     */
    public function view($id, ProductServiceInterface $productService)
    {

        return $this->render('product/index.html.twig', [
            'product' => $productService->getProductById($id),
        ]);
    }
}
