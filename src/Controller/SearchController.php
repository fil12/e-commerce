<?php

namespace App\Controller;

use App\Exception\NoContentException;
use App\Service\Category\CategoryServiceInterface;
use App\Service\Product\ParametersServiceInterface;
use App\Service\Product\ProductServiceInterface;
use App\Service\Search\SearchServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(SearchServiceInterface $searchService,
                          CategoryServiceInterface $categoryService,
                          ParametersServiceInterface $parametersService,
                          ProductServiceInterface $productService,
                          Request $request)
    {

        try{
            $products = $searchService->search($request->request->get('search'));
        } catch (NoContentException $e) {
            echo   $e->getMessage();
        }

        if ($request->query->get('filter')) {
            $products = $productService->getProductsByFilters($request->query->get('filter'));
        }

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'products' => $products,
            'categories' => $categoryService->getAllMainCategories(),
            'filters' => $parametersService->getAllProductsParameters(),
        ]);
    }
}
