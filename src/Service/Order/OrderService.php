<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 16.01.19
 * Time: 19:02
 */

namespace App\Service\Order;


use App\Entity\Customer;
use App\Entity\OrderProduct;
use App\Entity\Orders;
use App\Exception\NoContentException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderService implements OrderServiceInterface
{

    public const STATUS_NEW = 'new';

    private $em;
    private $session;

    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function createCustomer(Customer $customer)
    {
        $this->em->persist($customer);
        $this->em->flush();

        return $customer->getId();
    }

    public function createOrder(Orders $order)
    {


        if ( !$customerId = $this->session->get('customer')){
            throw new NoContentException('User not found. Please try registry again!');
        }

        $customer = $this->em->getRepository(Customer::class)->find($customerId);

        if (!$products = $this->session->get('cart')['products']){
            throw new NoContentException('Cart is empty. Please add products to cart!');
        }

        $order
            ->setStatus(self::STATUS_NEW)
            ->setCustomer($customer);


        foreach ($products as $product){
            $orderProduct = new OrderProduct();
            $orderProduct
                ->setProduct($product['id'])
                ->setOrder($order)
                ->setQty($product['qty']);

            $this->em->merge($orderProduct);
        }

        $this->em->persist($order);

        $this->em->flush();

        $this->session->remove('cart');
        return $order;
    }
}