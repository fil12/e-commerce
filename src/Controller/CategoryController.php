<?php

namespace App\Controller;

use App\Exception\NotFoundEntityException;
use App\Service\Category\CategoryServiceInterface;
use App\Service\Product\ParametersServiceInterface;
use App\Service\Product\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(
        CategoryServiceInterface $categoryService
    ) {
        try {
            $categories = $categoryService->getAllMainCategories();
        } catch (NotFoundEntityException $e) {
            throw $this->createNotFoundException($e->getMessage());
        }

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{slug}", name="category")
     */
    public function view(
        string $slug,
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        ParametersServiceInterface $parametersService,
        Request $request
        )
    {

        try {

            $categories = $categoryService->getAllMainCategories();

            $category = $categoryService->getCategoryBySlug($slug);

            $products = $productService->getCategoryProducts($category);

        } catch (NotFoundEntityException $e) {
            throw $this->createNotFoundException($e->getMessage());
        }





        if ($request->query->get('filter')) {
            $products = $productService->getProductsByFilters($request->query->get('filter'));
        }

        return $this->render('category/view.html.twig', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products,
            'filters' => $parametersService->getAllProductsParameters(),
        ]);
    }
}
