<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Cart\CartServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartServiceInterface $cartService)
    {
        $cart = $cartService->getCart();

//        foreach ($cart as $k=>$cartItems){
//            if($k !== 'quantity'){
//                foreach($cartItems as $item){
//                    dump($item['id']);
//
//                }
//            }
//        }
//        die();
        return $this->render('cart/index.html.twig', [
            'cart' => $cart
        ]);
    }

    /**
     * @Route("/cart-add/{id}", name="cart-add")
     */
    public function xhrAddToCart(Product $product, CartServiceInterface $cartService)
    {
        $cart = $cartService->addToCart($product);

        $response = [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
        ];

        return $this->json($response, Response::HTTP_CREATED);
    }

    /**
     * @Route("/cart-delete/{id}", name="cart-delete")
     */
    public function xhrDeleteProdcutFromCart(Product $product, CartServiceInterface $cartService)
    {
        $cart = $cartService->deleteProductFromCart($product);
        dd($cart);

        $response = [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
        ];
        return $this->json($response, Response::HTTP_OK);
    }

    /**
     * @Route("/cart-clean", name="cart-clean")
     */
    public function xhrCleanCart(CartServiceInterface $cartService)
    {
        $cart = $cartService->cleanCart();

        return $this->json('cleaned', Response::HTTP_OK);
    }
}
