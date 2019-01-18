<?php

namespace App\Controller;

use App\Service\Category\CategoryServiceInterface;
use App\Service\Product\ParametersServiceInterface;
use App\Service\Product\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Cocur\Slugify\Slugify;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(
        ProductServiceInterface $productService,
        CategoryServiceInterface $categoryService,
        ParametersServiceInterface $parametersService,
        Request $request
    )
    {

        $products = $productService->getAllProductsIsPublished();
        if ($request->query->get('filter')) {
            $products = $productService->getProductsByFilters($request->query->get('filter'));
        }
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'categories' => $categories = $categoryService->getAllMainCategories(),
            'products' => $products ?? 'Продукты не найдены',
            'filters' => $parametersService->getAllProductsParameters(),
            'new_produts' => $productService->getAllNewProducts(),
        ]);
    }
}
