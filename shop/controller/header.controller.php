<?php

function page_title() {
    $page = $_SERVER['REQUEST_URI'];

    switch($page) {
        case "/test/shop/home":
            $page_title = "Your Shop - Home Page";
            break;
        case "/test/shop/about":
            $page_title = "Your Shop - About Page";
            break;
        case "/test/shop/register":
            $page_title = "Account Registration";
            break;
        case "/test/shop/login":
            $page_title = "Login";
            break;
        case "/test/shop/contact":
            $page_title = "Your Shop - Contact Us";
            break;
        case "/test/shop/thankyou":
            $page_title = "Thankyou";
            break;
        case "/test/shop/myaccount":
            $page_title = "My Account";
            break;
        case "/test/shop/404":
            $page_title = "404 Page";
            break;
        case "/test/shop/wishlist":
            $page_title = "My Wish List";
            break;
        case "/test/shop/product":
            $page_title = "Your Shop - Categories";
            echo $page_title;
    }

    echo $page_title;
}