<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="d-flex flex-row bd-highlight mb-3"></div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight"><a href="#" style="text-decoration: none; color: black;"><i class="fa fa-user"></i> My Account</a></div>
            <div class="p-2 bd-highlight"><i class="fa fa-phone"></i> 091234567789</div>
        </div>
    </div>
</nav>

<!-- Logo -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="p-2 bd-highlight"><a class="navbar-brand" href="#">Logo</a></div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <a class="btn btn-md btn-secondary" href="#" role="button"><i class="fa fa-shopping-cart"></i> Shopping Cart</a>
            </div>
        </div>
    </div>
</nav>

<!-- Menu -->
<nav class="navbar sticky-top navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $BASE_URL ?>">Home</a>
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
                        <a class="dropdown-item" href="#">Sample 1</a>
                        <a class="dropdown-item" href="#">Sample 2</a>
                        <a class="dropdown-item" href="#">Sample 3</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>