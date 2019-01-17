<?php

namespace App\Controller;

use App\Form\CustomerType;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Order\OrderServiceInterface;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index()
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route("/create-customer", name="createCustomer")
     */
    public function createCustomer(OrderServiceInterface $orderService, Request $request)
    {
        $formCustomer = $this->createForm(CustomerType::class);
        $formCustomer->handleRequest($request);


        if ($formCustomer->isSubmitted() && $formCustomer->isValid()) {
            $customerId = $orderService->createCustomer($formCustomer->getData());
            $this->addFlash('success', 'Your data was successfully saved!');

            return $this->redirectToRoute('order', ['customerID' => $customerId]);
        }

        return $this->render('order/create-customer.html.twig', [
            'form' => $formCustomer->createView(),
        ]);
    }

    /**
     * @Route("/create-order", name="createOrder")
     */
    public function createOrder(OrderServiceInterface $orderService, Request $request)
    {
        $formOrder = $this->createForm(OrderType::class);
        $formOrder->handleRequest($request);

        if ($formOrder->isSubmitted() && $formOrder->isValid()) {
            dd($formOrder->getData());

            $order = $orderService->createCustomer($formOrder->getData());
            $this->addFlash('success', 'Your order was successfully saved!');

//            return $this->redirectToRoute('order', ['customerID' => $customerId]);
        }

        return $this->render('order/create-order.html.twig', [
            'form' => $formOrder->createView(),
        ]);
    }
}
