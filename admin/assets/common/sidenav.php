<?php $host = $_SERVER['REQUEST_URI']; ?>
    <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3"> Admin Dashboard </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo ($host == "/test/admin/home" ? "active" : "") ?>">
                <a class="nav-link" href="home">
                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item <?php echo ($host == "/test/admin/customer" ? "active" : "") ?>">
                <a class="nav-link" href="customer">
                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Customers</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSale"
                    aria-expanded="true" aria-controls="collapseSale">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Sales</span>
                </a>
                <div id="collapseSale" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="">Orders</a>
                        <a class="collapse-item" href="">Cancel Orders</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCatalog"
                    aria-expanded="true" aria-controls="collapseCatalog">
                    <i class="fas fa-tags"></i>
                    <span>Catalog</span>
                </a>
                <div id="collapseCatalog" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo ($host == "/test/admin/categories" ? "active" : "") ?>" href="categories">Categories</a>
                        <a class="collapse-item <?php echo ($host == "/test/admin/product" ? "active" : "") ?>" href="product">Products</a>
                        <a class="collapse-item <?php echo ($host == "/test/admin/information" ? "active" : "") ?>" href="information">Information</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed active" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Admin Control:</h6>
                        <a class="collapse-item <?php echo ($host == "/test/admin/user" ? "active" : "") ?>" href="user">Users</a>
                        <a class="collapse-item <?php echo ($host == "/test/admin/user_group" ? "active" : "") ?>" href="user_group">User Groups</a>
                        <a class="collapse-item <?php echo ($host == "/test/admin/weight" ? "active" : "") ?>" href="">Stock Statuses</a>
                        <a class="collapse-item <?php echo ($host == "/test/admin/weight" ? "active" : "") ?>" href="">Order Statuses</a>
                        <a class="collapse-item <?php echo ($host == "/test/admin/weight" ? "active" : "") ?>" href="">Weight Classes</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
    <!-- End of Sidebar -->