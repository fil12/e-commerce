<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 16.01.19
 * Time: 19:02
 */

namespace App\Service\Order;


use App\Entity\Customer;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;

class OrderService implements OrderServiceInterface
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createCustomer(Customer $customer)
    {
        $this->em->persist($customer);
        $this->em->flush();

        return $customer->getId();
    }

    public function createOrder(Order $order)
    {

    }
}