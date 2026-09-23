<?php

require_once __DIR__ . '/BaseController.php';

require_once __DIR__ . '/../Model/Customer.php';
require_once __DIR__ . '/../Model/Cart.php';
require_once __DIR__ . '/../Model/Crop.php';


class CartController extends BaseController
{
    private Customer $customerModel;
    private Cart $cartModel;
    private Crop $cropModel;


    public function __construct()
    {
        $this->customerModel =
            new Customer();

        $this->cartModel =
            new Cart();

        $this->cropModel =
            new Crop();
    }


    // ==========================================
    // CART PAGE
    // ==========================================

    public function index(): void
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


        $total = 0;


        foreach ($items as &$item) {

            $item['subtotal'] =
                (float)$item['cart_quantity']
                *
                (float)$item['price_per_kg'];

            $total +=
                $item['subtotal'];
        }


        unset($item);


        $this->view(
            'customer/cart',
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
    // ADD TO CART
    // ==========================================

    public function add(): void
    {
        $this->requireRole('customer');


        $cropId =
            (int)(
                $_POST['crop_id']
                ??
                $_GET['id']
                ??
                0
            );


        $quantity =
            (int)(
                $_POST['quantity']
                ?? 1
            );


        if (
            $cropId <= 0
            ||
            $quantity <= 0
        ) {

            $this->setMessage(
                'error',
                'Invalid cart information.'
            );

            $this->redirect(
                'index.php?page=crops'
            );
        }


        $crop =
            $this->cropModel
                ->findById(
                    $cropId
                );


        if (
            !$crop
            ||
            $crop['status'] !== 'active'
        ) {

            $this->setMessage(
                'error',
                'This product is not available.'
            );

            $this->redirect(
                'index.php?page=crops'
            );
        }


        if (
            $quantity >
            (float)$crop['quantity']
        ) {

            $this->setMessage(
                'error',
                'Requested quantity is not available.'
            );

            $this->redirect(
                'index.php?page=product-details&id='
                . $cropId
            );
        }


        $customer =
            $this->customerModel
                ->findByUserId(
                    $this->userId()
                );


        $added =
            $this->cartModel
                ->add(
                    $customer['customer_id'],
                    $cropId,
                    $quantity
                );


        $this->setMessage(
            $added
                ? 'success'
                : 'error',
            $added
                ? 'Product added to cart.'
                : 'Failed to add product to cart.'
        );


        $this->redirect(
            'index.php?page=cart'
        );
    }


    // ==========================================
    // UPDATE CART
    // ==========================================

    public function update(): void
    {
        $this->requireRole('customer');


        $cartId =
            (int)(
                $_POST['cart_id'] ?? 0
            );

        $quantity =
            (int)(
                $_POST['quantity'] ?? 0
            );


        if ($cartId <= 0) {

            $this->setMessage(
                'error',
                'Invalid cart item.'
            );

            $this->redirect(
                'index.php?page=cart'
            );
        }


        $updated =
            $this->cartModel
                ->updateQuantity(
                    $cartId,
                    $quantity
                );


        $this->setMessage(
            $updated
                ? 'success'
                : 'error',
            $updated
                ? 'Cart updated.'
                : 'Failed to update cart.'
        );


        $this->redirect(
            'index.php?page=cart'
        );
    }


    // ==========================================
    // REMOVE
    // ==========================================

    public function remove(): void
    {
        $this->requireRole('customer');


        $cartId =
            (int)(
                $_GET['id'] ?? 0
            );


        $removed =
            $this->cartModel
                ->remove(
                    $cartId
                );


        $this->setMessage(
            $removed
                ? 'success'
                : 'error',
            $removed
                ? 'Item removed from cart.'
                : 'Failed to remove item.'
        );


        $this->redirect(
            'index.php?page=cart'
        );
    }


    // ==========================================
    // CLEAR
    // ==========================================

    public function clear(): void
    {
        $this->requireRole('customer');


        $customer =
            $this->customerModel
                ->findByUserId(
                    $this->userId()
                );


        $cleared =
            $this->cartModel
                ->clear(
                    $customer['customer_id']
                );


        $this->setMessage(
            $cleared
                ? 'success'
                : 'error',
            $cleared
                ? 'Cart cleared.'
                : 'Failed to clear cart.'
        );


        $this->redirect(
            'index.php?page=cart'
        );
    }
}