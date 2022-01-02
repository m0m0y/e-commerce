<?php 
$host = $_SERVER['REQUEST_URI'];

switch ($host) {
    case "/test/admin/home":
        echo '
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        ';
        break;
    case "/test/admin/profile":
        echo '
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        ';
        break;
    case "/test/admin/user_group":
        echo '
            <h1 class="h3 mb-0 text-gray-800">User Groups</h1>
        ';
        break;
    case "/test/admin/user":
        echo'
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
        ';
        break;
    case "/test/admin/product":
        echo'
            <h1 class="h3 mb-0 text-gray-800">Products</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        ';
        break;
    case "/test/admin/add_product":
        echo '
            <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
        ';
        break;
    case "/test/admin/categories";
        echo '
            <h1 class="h3 mb-0 text-gray-800">Categories</h1>
        ';
        break;
    case "/test/admin/add_category";
        echo '
            <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
        ';
        break;
}