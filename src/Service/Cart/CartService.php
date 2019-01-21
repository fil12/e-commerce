<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 15.01.19
 * Time: 10:50.
 */

namespace App\Service\Cart;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService implements CartServiceInterface
{
    public const EMPTY_CART = 'Cart is empty';

    private $session;

    private $requestStack;

    private $em;

    public function __construct(SessionInterface $session, RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    public function addToCart(Product $product)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $cart = $session->get('cart', 'products');

        if (isset($cart['products'][$product->getId()])) {
            ++$cart['quantity'];
            ++$cart['products'][$product->getId()]['qty'];
        } else {
            $cart = $session->get('cart', []);
            $cart['products'][$product->getId()]['id'] = $product;
            $cart['products'][$product->getId()]['qty'] = isset($cart['products'][$product->getId()]['qty']) ? $cart['products'][$product->getId()]['qty'] + 1 : 1;
            $cart['quantity'] = isset($cart['quantity']) ? $cart['quantity'] + 1 : 1;
        }

        $session->set('cart', $cart);

        return $cart;
    }

    public function getCart()
    {
        $request = $this->requestStack->getCurrentRequest();
        $cart = $request->getSession()->get('cart');

        return $cart ?? null;
    }

    public function deleteProductFromCart(Product $product)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        if (isset($cart['products'][$product->getId()])) {
            if ($cart['products'][$product->getId()]['qty'] > 1) {
                --$cart['quantity'];
                --$cart['products'][$product->getId()]['qty'];
            } elseif (1 === $cart['quantity'] && 1 === count($cart['products'])) {
                $session->remove('cart');
            } else {
                unset($cart['products'][$product->getId()]);
            }
        }

        $session->set('cart', $cart);

        return $cart;
    }

    public function cleanCart()
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $session->remove('cart');

        return true;
    }
}
