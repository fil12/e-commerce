<?php

namespace App\Controller;

use App\Entity\ProductImages;
use App\Service\Category\CategoryServiceInterface;
use App\Service\Product\ParametersServiceInterface;
use App\Service\Product\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Cocur\Slugify\Slugify;



class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(
        ProductServiceInterface $productService,
        CategoryServiceInterface $categoryService,
        ParametersServiceInterface $parametersService
    )
    {
        $params = $parametersService->getAllProductsParameters();
        dd($params);
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'categories' => $categories = $categoryService->getAllMainCategories(),
            'products' => $productService->getAllProductsIsPublished()
        ]);
    }
}
