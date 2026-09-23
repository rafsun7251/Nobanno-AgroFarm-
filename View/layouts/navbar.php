<nav class="navbar">

    <div class="navbar-container">

        <a
            href="index.php"
            class="brand"
        >
            <span class="brand-bangla">
                নবান্ন
            </span>

            <span class="brand-name">
                Nobanno Agro Farm
            </span>
        </a>


        <div class="nav-links">

            <a href="index.php">
                Home
            </a>

            <a href="index.php?page=crops">
                Crops
            </a>


            <?php if (isset($_SESSION['user_id'])): ?>

                <?php

                $role =
                    strtolower(
                        $_SESSION['role'] ?? ''
                    );
                ?>


                <?php if ($role === 'customer'): ?>

                    <a
                        href="index.php?page=customer-dashboard"
                    >
                        Dashboard
                    </a>

                    <a
                        href="index.php?page=cart"
                    >
                        Cart
                    </a>

                    <a
                        href="index.php?page=customer-orders"
                    >
                        My Orders
                    </a>

                <?php endif; ?>


                <?php if ($role === 'farmer'): ?>

                    <a
                        href="index.php?page=farmer-dashboard"
                    >
                        Dashboard
                    </a>

                    <a
                        href="index.php?page=farmer-crops"
                    >
                        My Crops
                    </a>

                <?php endif; ?>


                <?php if ($role === 'admin'): ?>

                    <a
                        href="index.php?page=admin-dashboard"
                    >
                        Dashboard
                    </a>

                <?php endif; ?>


                <?php if (
                    $role === 'delivery_man'
                    ||
                    $role === 'delivery'
                ): ?>

                    <a
                        href="index.php?page=delivery-dashboard"
                    >
                        Dashboard
                    </a>

                <?php endif; ?>


                <a
                    href="index.php?page=logout"
                    class="logout-link"
                >
                    Logout
                </a>

            <?php else: ?>

                <a
                    href="index.php?page=login"
                >
                    Login
                </a>

                <a
                    href="index.php?page=register"
                >
                    Register
                </a>

            <?php endif; ?>

        </div>

    </div>

</nav>