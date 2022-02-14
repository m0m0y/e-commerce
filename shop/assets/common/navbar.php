<?php
if (isset($_SESSION["customer_id"])) {
    $customer_id = $_SESSION["customer_id"];
?>
<!-- Session Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="d-flex flex-row bd-highlight mb-3"></div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight"><i class="fa fas-check-circle"></i><a class="top-header-link" href="checkout"> Checkout</a></div>
            <div class="p-2 bd-highlight"><i class="fa fa-heart"></i><a class="top-header-link" href="wishlist"> Wish list (<?= $class->get_wishlist_rows($customer_id); ?>)</a></div>
            <div class="p-2 bd-highlight">
                <?= $class->get_info("info_description", "information_id='12' AND info_status='1'"); ?>
            </div>        
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="p-2 bd-highlight"><a class="navbar-brand" href="home"><img src="assets/images/shop_logo/logo.png" alt="Logo" height="130px"></a></div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <a class="btn btn-md btn-outline-secondary" href="cart" role="button"><i class="fa fa-shopping-cart"></i> Shopping Cart (<?= $class->get_cart_rows($customer_id) ?>)</a>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar sticky-top navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon menu"><i class="fa fa-list"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about">About Us</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Product Categories
                    </a>
                    <div class="dropdown-menu">
                        <?php $class->get_categories(); ?>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact">Contact Us</a>
                </li>
            </ul>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <a href="#" id="navbardrop" class="my-account-button" data-toggle="dropdown"><i class="fa fa-user"></i> My Account</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="myaccount">My Accout</a>
                    <a class="dropdown-item" href="order_history">Order History</a>
                    <a class="dropdown-item" href="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<?php } else { ?> 


<!-- No Session Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="d-flex flex-row bd-highlight mb-3"></div>

        <div class="d-flex flex-row-reverse bd-highlight">              
            <div class="p-2 bd-highlight">
                <i class="fa fa-check-circle"></i>
                <a class="top-header-link" href="checkout"> Checkout</a>
            </div>
            <div class="p-2 bd-highlight">
                <i class="fa fa-heart"></i>
                <a class="top-header-link" href="login"> Wish list (0)</a>
            </div>
            <div class="p-2 bd-highlight">
                <?= $class->get_info("info_description", "information_id='12' AND info_status='1'"); ?>
            </div> 
        </div>       
    </div>
</nav>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="d-flex flex-row bd-highlight">
            <div class="p-2 bd-highlight"><a class="navbar-brand" href="home"><img src="assets/images/shop_logo/logo.png" alt="Logo" height="130px"></a></div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <a class="btn btn-md btn-outline-secondary" href="cart" role="button"><i class="fa fa-shopping-cart"></i> Shopping Cart (<?= $class->get_cart_rows(0) ?>)</a>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar sticky-top navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon menu"><i class="fa fa-list"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about">About Us</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Product Categories
                    </a>
                    <div class="dropdown-menu">
                        <?php $class->get_categories(); ?>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact">Contact Us</a>
                </li>
            </ul>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <a href="#" id="navbardrop" class="my-account-button" data-toggle="dropdown"><i class="fa fa-user"></i> My Account</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="register">Register</a>
                    <a class="dropdown-item" href="login">Login</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php } ?>
