<?php

$pageTitle = 'My Cart';

$extraCss = [
    'public/css/cart.css'
];

$extraJs = [
    'public/js/cart.js'
];

require __DIR__ . '/../layouts/header.php';

?>

<main class="cart-page">

    <div class="page-container">

        <div class="page-header">

            <h1>
                My Cart
            </h1>

        </div>


        <?php if (empty($items)): ?>

            <div class="empty-state">

                <h2>
                    Your cart is empty
                </h2>

                <p>
                    Browse our fresh farm
                    products and add something.
                </p>

                <a
                    href="index.php?page=crops"
                    class="btn btn-primary"
                >
                    Browse Products
                </a>

            </div>


        <?php else: ?>


            <div class="cart-layout">


                <div class="cart-items">


                    <?php foreach (
                        $items
                        as $item
                    ): ?>

                        <div class="cart-item">


                            <div class="cart-item-info">

                                <h3>

                                    <?= htmlspecialchars(
                                        $item['crop_name']
                                    ) ?>

                                </h3>

                                <p>

                                    ৳<?= number_format(
                                        (float)$item[
                                            'price_per_kg'
                                        ],
                                        2
                                    ) ?>

                                    /kg

                                </p>

                            </div>


                            <form
                                action="index.php?page=cart-update"
                                method="POST"
                                class="cart-quantity-form"
                            >

                                <input
                                    type="hidden"
                                    name="cart_id"
                                    value="<?= (int)$item['cart_id'] ?>"
                                >


                                <input
                                    type="number"
                                    name="quantity"
                                    value="<?= (int)$item['cart_quantity'] ?>"
                                    min="1"
                                    max="<?= (float)$item['available_quantity'] ?>"
                                >


                                <button
                                    type="submit"
                                    class="btn btn-secondary"
                                >
                                    Update
                                </button>

                            </form>


                            <div class="cart-subtotal">

                                ৳<?= number_format(
                                    (float)$item[
                                        'subtotal'
                                    ],
                                    2
                                ) ?>

                            </div>


                            <a
                                href="index.php?page=cart-remove&id=<?= (int)$item['cart_id'] ?>"
                                class="remove-item"
                                onclick="return confirm('Remove this item?')"
                            >
                                Remove
                            </a>


                        </div>

                    <?php endforeach; ?>


                    <a
                        href="index.php?page=cart-clear"
                        class="clear-cart"
                        onclick="return confirm('Clear your cart?')"
                    >
                        Clear Cart
                    </a>


                </div>


                <aside class="cart-summary">

                    <h2>
                        Order Summary
                    </h2>


                    <div class="summary-row">

                        <span>
                            Subtotal
                        </span>

                        <strong>
                            ৳<?= number_format(
                                $total,
                                2
                            ) ?>
                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>
                            Delivery
                        </span>

                        <strong>
                            Calculated at checkout
                        </strong>

                    </div>


                    <hr>


                    <div class="summary-total">

                        <span>
                            Total
                        </span>

                        <strong>
                            ৳<?= number_format(
                                $total,
                                2
                            ) ?>
                        </strong>

                    </div>


                    <a
                        href="index.php?page=checkout"
                        class="btn btn-primary btn-full"
                    >
                        Proceed to Checkout
                    </a>

                </aside>

            </div>

        <?php endif; ?>

    </div>

</main>


<?php
require __DIR__ . '/../layouts/footer.php';
?>