<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = 'Nobanno | Fresh From Farmers';
$extraCss = [
    'public/css/home.css'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="public/css/home.css">
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <a href="index.php" class="logo">
            <div class="logo-icon">🌾</div>
            <div class="logo-text">
                <h2>নবান্ন</h2>
                <span>Fresh From Farmers</span>
            </div>
        </a>

        <nav class="nav-links">
            <a href="index.php" class="nav-link active">Home</a>
            <a href="index.php?page=crops" class="nav-link">Crops</a>
            <a href="index.php?page=about" class="nav-link">About Us</a>
            <a href="index.php?page=contact" class="nav-link">Contact</a>
        </nav>

        <div class="nav-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php
                    $role = strtolower(trim($_SESSION['role'] ?? ''));
                    $dashboardPage = match ($role) {
                        'admin' => 'admin-dashboard',
                        'farmer' => 'farmer-dashboard',
                        'delivery', 'delivery_man' => 'delivery-dashboard',
                        default => 'customer-dashboard'
                    };
                ?>
                <a href="index.php?page=<?= $dashboardPage ?>" class="nav-dashboard">Dashboard</a>
                <a href="index.php?page=logout" class="nav-login">Logout</a>
            <?php else: ?>
                <a href="index.php?page=login" class="nav-login">Login</a>
                <a href="index.php?page=register" class="nav-register">Get Started</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- =====================================================
     HERO SECTION
===================================================== -->

<section class="hero">

    <div class="hero-container">


        <!-- HERO CONTENT -->

        <div class="hero-content">

            <div class="hero-badge">
                <span>🌱</span>
                Fresh • Local • Trusted
            </div>


            <h1>

                Fresh From
                <span>Our Farmers</span>
                To Your Table

            </h1>


            <p>

                Nobanno connects farmers and customers
                through a simple agricultural marketplace.
                Discover fresh crops, support local farmers,
                and enjoy quality products delivered to you.

            </p>


            <div class="hero-buttons">

                <a
                    href="index.php?page=crops"
                    class="btn-primary"
                >
                    Explore Crops
                    <span>→</span>
                </a>


                <a
                    href="index.php?page=register"
                    class="btn-secondary"
                >
                    Join Nobanno
                </a>

            </div>


            <div class="hero-trust">

                <div class="trust-item">

                    <strong>100%</strong>

                    <span>Fresh Products</span>

                </div>


                <div class="trust-divider"></div>


                <div class="trust-item">

                    <strong>Local</strong>

                    <span>Farmers</span>

                </div>


                <div class="trust-divider"></div>


                <div class="trust-item">

                    <strong>Easy</strong>

                    <span>Ordering</span>

                </div>

            </div>

        </div>



        <!-- HERO VISUAL -->

        <div class="hero-visual">

            <div class="hero-circle"></div>

            <div class="hero-main-card">

                <div class="hero-image">

                    <span>🌾</span>

                </div>

                <div class="hero-card-content">

                    <span class="fresh-label">
                        Fresh Today
                    </span>

                    <h3>
                        Farm Fresh Crops
                    </h3>

                    <p>
                        Directly from local farmers
                    </p>

                </div>

            </div>


            <div class="floating-card floating-card-one">

                <div class="floating-icon">
                    🌱
                </div>

                <div>

                    <strong>
                        Fresh Harvest
                    </strong>

                    <span>
                        Available now
                    </span>

                </div>

            </div>


            <div class="floating-card floating-card-two">

                <div class="floating-icon">
                    🚚
                </div>

                <div>

                    <strong>
                        Fast Delivery
                    </strong>

                    <span>
                        To your doorstep
                    </span>

                </div>

            </div>

        </div>


    </div>

</section>



<!-- =====================================================
     CATEGORIES
===================================================== -->

<section class="categories section">

    <div class="container">

        <div class="section-heading">

            <span class="section-tag">
                EXPLORE
            </span>

            <h2>
                What Are You Looking For?
            </h2>

            <p>
                Discover fresh agricultural products
                from trusted local farmers.
            </p>

        </div>


        <div class="category-grid">


            <a
                href="index.php?page=crop-search&category=vegetables"
                class="category-card"
            >

                <div class="category-icon vegetable-icon">
                    🥬
                </div>

                <h3>Vegetables</h3>

                <p>
                    Fresh seasonal vegetables
                </p>

                <span class="category-arrow">
                    →
                </span>

            </a>


            <a
                href="index.php?page=crop-search&category=fruits"
                class="category-card"
            >

                <div class="category-icon fruit-icon">
                    🍎
                </div>

                <h3>Fruits</h3>

                <p>
                    Naturally grown fresh fruits
                </p>

                <span class="category-arrow">
                    →
                </span>

            </a>


            <a
                href="index.php?page=crop-search&category=grains"
                class="category-card"
            >

                <div class="category-icon grain-icon">
                    🌾
                </div>

                <h3>Grains</h3>

                <p>
                    Quality grains from farmers
                </p>

                <span class="category-arrow">
                    →
                </span>

            </a>


            <a
                href="index.php?page=crop-search&category=other"
                class="category-card"
            >

                <div class="category-icon other-icon">
                    🧺
                </div>

                <h3>Other Crops</h3>

                <p>
                    Explore more farm products
                </p>

                <span class="category-arrow">
                    →
                </span>

            </a>


        </div>

    </div>

</section>



<!-- =====================================================
     HOW IT WORKS
===================================================== -->

<section class="how-section section">

    <div class="container">

        <div class="section-heading">

            <span class="section-tag">
                HOW IT WORKS
            </span>

            <h2>
                From Farm To Your Door
            </h2>

            <p>
                Getting fresh agricultural products
                has never been easier.
            </p>

        </div>


        <div class="steps">


            <div class="step">

                <div class="step-number">
                    01
                </div>

                <div class="step-icon">
                    🔎
                </div>

                <h3>
                    Explore
                </h3>

                <p>
                    Browse fresh crops available
                    from our farmers.
                </p>

            </div>


            <div class="step-line"></div>


            <div class="step">

                <div class="step-number">
                    02
                </div>

                <div class="step-icon">
                    🛒
                </div>

                <h3>
                    Order
                </h3>

                <p>
                    Choose your products and
                    place your order easily.
                </p>

            </div>


            <div class="step-line"></div>


            <div class="step">

                <div class="step-number">
                    03
                </div>

                <div class="step-icon">
                    🚚
                </div>

                <h3>
                    Receive
                </h3>

                <p>
                    Get your fresh products
                    delivered to your doorstep.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     FARMER CTA
===================================================== -->

<section class="farmer-section">

    <div class="container">

        <div class="farmer-card">


            <div class="farmer-content">

                <span class="section-tag light-tag">
                    FOR FARMERS
                </span>

                <h2>
                    Grow More.
                    <span>Sell Better.</span>
                </h2>

                <p>
                    Join Nobanno and reach more customers
                    with your fresh agricultural products.
                    Grow your digital presence and manage
                    your products easily.
                </p>

                <a
                    href="index.php?page=register"
                    class="farmer-btn"
                >
                    Become a Farmer
                    <span>→</span>
                </a>

            </div>


            <div class="farmer-visual">

                <div class="farmer-circle">

                    <span>
                        👨‍🌾
                    </span>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     WHY NOBANNO
===================================================== -->

<section class="why-section section">

    <div class="container">


        <div class="section-heading">

            <span class="section-tag">
                WHY NOBANNO
            </span>

            <h2>
                Better For Farmers.
                Better For You.
            </h2>

            <p>
                We make agricultural commerce simple,
                transparent and accessible.
            </p>

        </div>


        <div class="benefits-grid">


            <div class="benefit-card">

                <div class="benefit-icon">
                    🌱
                </div>

                <h3>
                    Fresh Products
                </h3>

                <p>
                    Get quality agricultural products
                    sourced directly from farmers.
                </p>

            </div>


            <div class="benefit-card">

                <div class="benefit-icon">
                    🤝
                </div>

                <h3>
                    Support Farmers
                </h3>

                <p>
                    Help local farmers reach customers
                    and grow their businesses.
                </p>

            </div>


            <div class="benefit-card">

                <div class="benefit-icon">
                    🔒
                </div>

                <h3>
                    Trusted Platform
                </h3>

                <p>
                    A simple and reliable platform
                    for agricultural transactions.
                </p>

            </div>


            <div class="benefit-card">

                <div class="benefit-icon">
                    🚚
                </div>

                <h3>
                    Easy Delivery
                </h3>

                <p>
                    Convenient delivery makes getting
                    your products simple.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     FINAL CTA
===================================================== -->

<section class="final-cta">

    <div class="container">

        <div class="final-cta-content">

            <span>
                READY TO GET STARTED?
            </span>

            <h2>
                Freshness Starts Here.
            </h2>

            <p>
                Explore fresh crops from farmers
                and experience Nobanno today.
            </p>


            <div class="final-buttons">

                <a
                    href="index.php?page=crops"
                    class="btn-primary"
                >
                    Explore Crops
                    <span>→</span>
                </a>

                <a
                    href="index.php?page=register"
                    class="btn-outline"
                >
                    Create Account
                </a>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer">

    <div class="container">

        <div class="footer-grid">


            <div class="footer-brand">

                <a
                    href="index.php"
                    class="logo footer-logo"
                >

                    <div class="logo-icon">
                        🌾
                    </div>

                    <div class="logo-text">

                        <h2>Nobanno</h2>

                        <span>
                            Fresh From Farmers
                        </span>

                    </div>

                </a>

                <p>
                    Connecting farmers and customers
                    through a better agricultural marketplace.
                </p>

            </div>


            <div class="footer-column">

                <h3>
                    Explore
                </h3>

                <a href="index.php">
                    Home
                </a>

                <a href="index.php?page=crops">
                    Crops
                </a>

                <a href="index.php?page=about">
                    About Us
                </a>

                <a href="index.php?page=contact">
                    Contact
                </a>

            </div>


            <div class="footer-column">

                <h3>
                    Account
                </h3>

                <a href="index.php?page=login">
                    Login
                </a>

                <a href="index.php?page=register">
                    Register
                </a>

            </div>


            <div class="footer-column">

                <h3>
                    Contact
                </h3>

                <p>
                    Dhaka, Bangladesh
                </p>

                <p>
                    support@nobanno.com
                </p>

            </div>


        </div>


        <div class="footer-bottom">

            <p>
                © <?php echo date("Y"); ?>
                Nobanno. All rights reserved.
            </p>

            <p>
                Fresh From Farmers
            </p>

        </div>

    </div>

</footer>



</body>
</html>
