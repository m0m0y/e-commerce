<?php

function page_title() {
    $page = $_SERVER['REQUEST_URI'];

    switch($page) {
        case "/test/":
            $title = "Shop - Home Page";
            break;
        case "/test/shop/about":
            $title = "Shop - About Page";
            break;
    }

    echo $title;
}