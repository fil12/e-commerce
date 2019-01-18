<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 16.01.19
 * Time: 19:02
 */

namespace App\Service\Order;


use App\Entity\Customer;
use App\Entity\Orders;

interface OrderServiceInterface
{
    public function createCustomer(Customer $customer);

    public function createOrder(Orders $order);

}