<?php

namespace App\Controller;

use App\Exception\NotFoundEntityException;
use App\Service\Category\CategoryServiceInterface;
use App\Service\Product\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="categories")
     */
    public function index()
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/category/{slug}", name="category")
     */
    public function view(
        string $slug,
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        Request $request
        )
    {
        try {
            $category = $categoryService->getCategoryBySlug($slug);
        } catch (NotFoundEntityException $e) {
            throw $this->createNotFoundException($e->getMessage());
        }

        $products = $productService->getCategoryProducts($category);

        dd($products);
        return $this->render('category/view.html.twig', [
            'category' => $category
        ]);
    }
}
