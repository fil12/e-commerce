<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 15.01.19
 * Time: 10:50
 */

namespace App\Service\Cart;


use App\Entity\Product;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;


class CartService implements CartServiceInterface
{
    public const EMPTY_CART = 'Cart is empty';

    private $session;

    private $requestStack;

    public function __construct(SessionInterface $session, RequestStack $requestStack)
    {
        $this->session = $session;
        $this->requestStack = $requestStack;
    }

    public function addToCart(Product $product)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        if (isset($cart[$product->getId()])) {

            $cart['quantity']++;
            $cart[$product->getId()]['qty']++;

        } else {
            $cart = $session->get('cart', array());
            $cart[$product->getId()]['product'] = $product;
            $cart[$product->getId()]['qty'] = isset($cart[$product->getId()]['qty']) ? $cart[$product->getId()]['qty'] + 1 : 1;
            $cart['quantity'] = isset($cart['quantity']) ? $cart['quantity'] + 1 : 1;
        }

        $session->set('cart', $cart);

        return $cart;
    }


    public function getCart()
    {
        $request = $this->requestStack->getCurrentRequest();
        $cart = $request->getSession()->get('cart');

        return $cart ?? self::EMPTY_CART;
    }


    public function deleteProductFromCart(Product $product)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        if (isset($cart[$product->getId()])) {

            if ($cart[$product->getId()]['qty'] > 1) {
                $cart['quantity']--;
                $cart[$product->getId()]['qty']--;

            } else if ($cart['quantity'] === 1 && count($cart) === 2) {
                $session->clear();
                dd($cart);

            } else {
                unset($cart[$product->getId()]);
            }
        }

        $session->set('cart', $cart);

        return $cart;
    }

    public function cleanCart()
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $session->clear();

        return true;
    }
}