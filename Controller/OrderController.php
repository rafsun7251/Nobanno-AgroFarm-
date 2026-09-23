<?php

require_once __DIR__ . '/BaseController.php';

require_once __DIR__ . '/../Model/Customer.php';
require_once __DIR__ . '/../Model/Cart.php';
require_once __DIR__ . '/../Model/Crop.php';
require_once __DIR__ . '/../Model/Order.php';
require_once __DIR__ . '/../Model/OrderItem.php';
require_once __DIR__ . '/../Model/Payment.php';


class OrderController extends BaseController
{
    private Customer $customerModel;
    private Cart $cartModel;
    private Crop $cropModel;
    private Order $orderModel;
    private OrderItem $orderItemModel;
    private Payment $paymentModel;


    public function __construct()
    {
        $this->customerModel =
            new Customer();

        $this->cartModel =
            new Cart();

        $this->cropModel =
            new Crop();

        $this->orderModel =
            new Order();

        $this->orderItemModel =
            new OrderItem();

        $this->paymentModel =
            new Payment();
    }


    // ==========================================
    // CHECKOUT PAGE
    // ==========================================

    public function checkout(): void
    {
        $this->requireRole('customer');


        $customer =
            $this->customerModel
                ->findByUserId(
                    $this->userId()
                );


        $items =
            $this->cartModel
                ->getByCustomer(
                    $customer['customer_id']
                );


        if (empty($items)) {

            $this->setMessage(
                'error',
                'Your cart is empty.'
            );

            $this->redirect(
                'index.php?page=cart'
            );
        }


        $total = 0;


        foreach ($items as $item) {

            $total +=
                (float)$item['cart_quantity']
                *
                (float)$item['price_per_kg'];
        }


        $this->view(
            'customer/checkout',
            [
                'customer' =>
                    $customer,

                'items' =>
                    $items,

                'total' =>
                    $total
            ]
        );
    }


    // ==========================================
    // CREATE ORDER
    // ==========================================

    public function create(): void
    {
        $this->requireRole('customer');


        $customer =
            $this->customerModel
                ->findByUserId(
                    $this->userId()
                );


        if (!$customer) {

            $this->redirect(
                'index.php?page=login'
            );
        }


        $items =
            $this->cartModel
                ->getByCustomer(
                    $customer['customer_id']
                );


        if (empty($items)) {

            $this->setMessage(
                'error',
                'Your cart is empty.'
            );

            $this->redirect(
                'index.php?page=cart'
            );
        }


        $deliveryAddress =
            trim(
                $_POST['delivery_address']
                ?? ''
            );


        $deliveryCharge =
            (float)(
                $_POST['delivery_charge']
                ?? 0
            );


        $paymentMethod =
            trim(
                $_POST['payment_method']
                ?? ''
            );


        $transactionId =
            trim(
                $_POST['transaction_id']
                ?? ''
            );


        if (
            $deliveryAddress === ''
        ) {

            $this->setMessage(
                'error',
                'Delivery address is required.'
            );

            $this->redirect(
                'index.php?page=checkout'
            );
        }


        $total = 0;


        foreach ($items as $item) {

            $available =
                (float)$item[
                    'available_quantity'
                ];

            $requested =
                (float)$item[
                    'cart_quantity'
                ];


            if ($requested > $available) {

                $this->setMessage(
                    'error',
                    'Insufficient stock for '
                    . $item['crop_name']
                );

                $this->redirect(
                    'index.php?page=cart'
                );
            }


            $total +=
                $requested
                *
                (float)$item[
                    'price_per_kg'
                ];
        }


        $grandTotal =
            $total + $deliveryCharge;


        /*
         * Create order
         */

        $orderId =
            $this->orderModel
                ->create(
                    $customer['customer_id'],
                    $grandTotal,
                    $deliveryCharge,
                    $deliveryAddress
                );


        if (!$orderId) {

            $this->setMessage(
                'error',
                'Failed to create order.'
            );

            $this->redirect(
                'index.php?page=checkout'
            );
        }


        /*
         * Create order items
         */

        foreach ($items as $item) {

            $this->orderItemModel
                ->create(
                    $orderId,
                    $item['crop_id'],
                    $item['cart_quantity'],
                    $item['price_per_kg']
                );


            /*
             * Reduce stock
             */

            $newQuantity =
                (float)$item[
                    'available_quantity'
                ]
                -
                (float)$item[
                    'cart_quantity'
                ];


            $this->cropModel
                ->updateQuantity(
                    $item['crop_id'],
                    $newQuantity
                );
        }


        /*
         * Payment
         */

        if ($paymentMethod !== '') {

            $this->paymentModel
                ->create(
                    $orderId,
                    $customer['customer_id'],
                    $grandTotal,
                    $paymentMethod,
                    $transactionId
                );
        }


        /*
         * Clear cart
         */

        $this->cartModel
            ->clear(
                $customer['customer_id']
            );


        $this->setMessage(
            'success',
            'Order placed successfully.'
        );


        $this->redirect(
            'index.php?page=customer-orders'
        );
    }
}