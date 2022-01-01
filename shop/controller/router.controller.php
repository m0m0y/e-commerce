<?php

class Router {
    private $request;

    public function page() {
        $page = '404';

        if(isset($_SERVER["REQUEST_URI"])) {
            $uri = explode("/", $_SERVER["REQUEST_URI"]);
            $page = isset($uri[2]) && !empty($uri[2]) ? $uri[2] : 'home';
        } else {
            $page = 'home';
        }

        if($page == "page") {
            if(isset($_SERVER["REQUEST_URI"])) {
                $uri = explode("/", $_SERVER["REQUEST_URI"]);
                $page = isset($uri[1]) && !empty($uri[1]) ? $uri[1] : 'home';
            }
        }

        $this->request = $page;
        return $this;
    }

    public function renderPage() {
        require "shop/include/include.php";

        switch($this->request) {
            case "":
            case "home":
                $page_title = "Your Shop - Home page";
                require "shop/home.php";
                break;
            case "about":
                $page_title = "Your Shop - About us";
                require "shop/about.php";
                break;
            case "contact":
                $page_title = "Your Shop - Contact Us";
                require "shop/contact.php";
                break;
            case "thankyou":
                $page_title = "Thank you";
                require "shop/thankyou.php";
                break;
            case "login";
                $page_title = "Account Login";
                require "shop/login.php";
                break;
            case "register";
                $page_title = "Account Register";
                require "shop/register.php";
                break;
            case "logout";
                require "shop/logout.php";
                break;
            case "myaccount";
                $page_title = "My Account";
                require "shop/myaccount.php";
                break;
        }
    }

}