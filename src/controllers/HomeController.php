<?php

session_start();

class HomeController extends RenderView {

    private $authenticated;

    public function __construct()
    {
        $this->authenticated = isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0  ?  1 : 0;
    }

    public function logout() {
        unset($_SESSION["user_id"]);
        header("location: " . APP_URL);
    }

    // Home Page
    public function index() {

        
        $this->loadView("pages/partials/header", [
            "title" => "Home Page",
        ]);

        $this->loadView("pages/home", []);

        $this->loadView("pages/partials/footer", []);
    }

    //products page
    public function products() {
        $this->loadView("pages/partials/header", [
            "title" => "Products",
        ]);

        $this->loadView("pages/products", []);

        $this->loadView("pages/partials/footer-quick-contact", []);
        
        $this->loadView("pages/partials/footer", []);
    }

    public function productItem() {

        $this->loadView("pages/partials/header", [
            "title" => "Product Item",
        ]);

        $this->loadView("pages/product-item", []);

        $this->loadView("pages/partials/footer-quick-contact", []);
        $this->loadView("pages/partials/footer", []);
    }

    public function getQuote(){

        $this->loadView("pages/partials/header", [
            "title" => "Get a Quote",
        ]);

        $this->loadView("pages/get-a-quote", []);

        $this->loadView("pages/partials/footer", []);
    }

    public function aboutUs() {
        $this->loadView("pages/partials/header", [
            "title" => "About Us",
        ]);

        $this->loadView("pages/about-us", []);

        $this->loadView("pages/partials/footer-quick-contact", []);
        $this->loadView("pages/partials/footer", []);
    }

    public function faqs(){

        $this->loadView("pages/partials/header", [
            "title" => "Frequently Asked Questions",
        ]);

        $this->loadView("pages/faqs", []);

        $this->loadView("pages/partials/footer-quick-contact", []);
        $this->loadView("pages/partials/footer", []);
        
    }

}