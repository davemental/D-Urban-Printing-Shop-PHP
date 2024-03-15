<?php

class HomeController extends RenderView {

    // Home Page
    public function index() {
        $this->loadView("pages/partials/header", [
            "title" => "Home Page",
        ]);

        $product = new Product();
        $imgData = new imageCarousel();

        $this->loadView("pages/home", [
            "productData" => $product->getAllProducts(),
            "imgSlide" => $imgData->getAllImage(),
        ]);

        $this->loadView("pages/partials/footer", []);
    }

    // this will received and save to db the contact form request data in home page
    public function submitContactForm(){
        
        $msg = [];
        $user = new Quote();

        if (!isset($_POST["name"]) || empty($_POST["name"])) {
            $msg['error'] = "name is required";
        } else if (!isset($_POST["email"]) || empty($_POST["email"])) {
            $msg['error'] = "Email is required";
        } else if (!isset($_POST["contact_number"]) || empty($_POST["contact_number"])) {
            $msg['error'] = "Contact number is required"; 
        } else if (!isset($_POST["message"]) || empty($_POST["message"])) {
            $msg['error'] = "Your inquiry message/details is required"; 
        } else {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $contact_number = $_POST["contact_number"];
            $message = $_POST["message"];

            if ($user->saveContactRequest($name, $email, $contact_number, $message)) {
                $msg['success'] = "Thank you very much, your request has been sent. Kindly wait for a few moments for our reply.";

                // send copy to email address
            } else {
                $msg['error'] = "Some problems encountered while sending your request. Please try again later";
            }
        }
        echo json_encode($msg);
    }
    
    // this will received and save to db the send inquiry received from get a quote page
    public function submitInquiryForm() {

        $msg = [];
        $user = new Quote();

        if (!isset($_POST["name"]) || empty($_POST["name"])) {
            $msg['error'] = "Name is required";
        } else if (!isset($_POST["email"]) || empty($_POST["email"])) {
            $msg['error'] = "Email is required";
        } else if (!isset($_POST["contact_number"]) || empty($_POST["contact_number"])) {
            $msg['error'] = "Contact number is required";  
        } else if (!isset($_POST["address"]) || empty($_POST["address"])) {
            $msg['error'] = "Address is required";
        } else if (!isset($_POST["product"]) || empty($_POST["product"])) {
            $msg['error'] = "Selected product is required"; 
        } else if (!isset($_POST["quantity"]) || empty($_POST["quantity"])) {
            $msg['error'] = "Estimated order quantity is required"; 
        } else if (!isset($_POST["details"]) || empty($_POST["details"])) {
            $msg['error'] = "Your inquiry message/details is required"; 
        } else {

            $string_helper = new StringHelper();
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/D-URBAN/public/quote-file/';

            $name = $_POST["name"];
            $email = $_POST["email"];
            $contact_number = $_POST["contact_number"];
            $company =  $_POST["company"] = isset($_POST["company"]) ? $_POST["company"] : "";
            $address = $_POST["address"];
            $product = $_POST["product"];
            $quantity = $_POST["quantity"];
            $details = $_POST["details"];
            $file_uploadArr = $_FILES["file_upload"];

            $file_upload_fn = "";

            // upload only if has a file
            if (!empty(array_filter($file_uploadArr))) {
                // change file name for feature image
                $file_upload_fn = $string_helper->changeFileName($file_uploadArr["name"][0]);
                //uploading featured images
                move_uploaded_file($file_uploadArr["tmp_name"][0], $uploadDir . $file_upload_fn);
            }
            
            // save data to db
            if ($user->saveSendInquiryRequest($name, $email, $contact_number, $company, $address, $product, $quantity, $details, $file_upload_fn)) {
                $msg['success'] = "Thank you very much, your request has been sent. Kindly wait for a few moments for our reply.";

                // send copy to email address
            } else {
                $msg['error'] = "Some problems encountered while sending your request. Please try again later";
            }
        }
        echo json_encode($msg);
    }

    public function requestProductSearch() {

        $product = new Product();
        $productData = [];

        if (!(isset($_POST['search_key'])) || !(empty($_POST['search_key']))) {

            $productKey = $_POST['search_key'];
            $productKey = preg_replace('/[^A-Za-z0-9\s]/', '', $productKey); // clean the search key

            // get records
            $productData = $product->getProductByName($productKey);
         }

         echo json_encode($productData);
           
    }

    //products page
    public function products() {
        $this->loadView("pages/partials/header", [
            "title" => "Products",
        ]);

        $product = new Product();
        $allProducts = $product->getAllProducts();

        $this->loadView("pages/products", [
            "productData" => $allProducts,
        ]);

        $this->loadView("pages/partials/footer-quick-contact", []);
        
        $this->loadView("pages/partials/footer", []);
    }

    public function productItems() {

        $id = $_GET["id"];

        $product = new Product();
        $productItem = $product->getProductById($id);

        $this->loadView("pages/partials/header", [
            "title" => "Product Item",
        ]);

        $this->loadView("pages/product-item", [
            "productData" => $productItem,
        ]);

        $this->loadView("pages/partials/footer-quick-contact", []);
        $this->loadView("pages/partials/footer", []);
    }

    public function getQuote(){

        $this->loadView("pages/partials/header", [
            "title" => "Get a Quote",
        ]);

        $product = new Product();
        $all_products = $product->getAllProducts();

        $this->loadView("pages/get-a-quote", [
            "productData" => $all_products
        ]);

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