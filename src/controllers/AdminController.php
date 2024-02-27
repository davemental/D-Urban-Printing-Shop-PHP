<?php

session_start();

class AdminController extends RenderView {

    private $authenticated;

    public function __construct()
    {
        $this->authenticated = isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0  ?  1 : 0;
    }

    public function logout() {
        unset($_SESSION["user_id"]);
        header("location: " . APP_URL);
    }


    public function index() {

        $this->loadView("pages/partials/admin-header", [
            "title" => "Dashboard",
        ]);

        $this->loadView("pages/admin/index", []);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function products() {
        $this->loadView("pages/partials/admin-header", [
            "title" => "Product Management",
        ]);

        $this->loadView("pages/admin/products", [
            "title" => "Product Management",
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function addProduct() {
        $this->loadView("pages/partials/admin-header", [
            "title" => "Add Product",
        ]);

        $this->loadView("pages/admin/add-product", [
            "title" => "Add Product",
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function createProduct() {

        $msg = [];
        $featureImgIsUploaded = false;
        $sampleImgIsUploaded = false;
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/D-URBAN/public/images/uploads/products/';

        $product = new Product();

        if (!isset($_POST["title"]) || empty($_POST["title"])) {
            $msg['error'] = "Please enter a title";
        } else if (!isset($_POST["description"]) || empty($_POST["description"])) {
            $msg['error'] = "Please enter a Product Description";
        } else if (!isset($_FILES["featured_img"])) {
            $msg['error'] = "Please upload a featured image"; 
        } else {
            $title = $_POST["title"];
            $description = $_POST["description"];
            $featured_img_file_name = $_FILES["featured_img"]["name"][0];
            $featured_img_tmp_name = $_FILES["featured_img"]["tmp_name"][0];

            $sample_img_file_name = $_FILES["sample_img"]["name"];
            $sample_img_tmp_name = $_FILES["sample_img"]["tmp_name"];

            // change file name for feature image
            $featured_img_file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $featured_img_file_name);
            $featured_img_ext =  pathinfo($_FILES["featured_img"]["name"][0], PATHINFO_EXTENSION);
            $featured_img_file_name = $featured_img_file_name . time() . ".". $featured_img_ext;
            
             //uploading featured images
            if (move_uploaded_file($featured_img_tmp_name, $uploadDir .  $featured_img_file_name)) {
                $featureImgIsUploaded = true;
            }

            $sample_images = "";

            // uploading sample images
            for ($i = 0; $i < count($sample_img_file_name); $i++) {

                // change file name for sample images
                $sample_img_file_name_str = preg_replace('/\\.[^.\\s]{3,4}$/', '', $sample_img_file_name[$i]);
                $sample_img_ext =  pathinfo($sample_img_file_name[$i], PATHINFO_EXTENSION);
                $sample_img_file_name_str = $sample_img_file_name_str . time() . ".". $sample_img_ext;

                if (move_uploaded_file($sample_img_tmp_name[$i], $uploadDir .  $sample_img_file_name_str)) {
                    if (empty($sample_images)) {
                        $sample_images =  $sample_img_file_name_str;
                    } else {
                        $sample_images = $sample_images . ", ". $sample_img_file_name_str;
                    }

                    $sampleImgIsUploaded = true;
                }
            }

            if ($featureImgIsUploaded) {
                if ($product->create($title, $description, $featured_img_file_name, $sample_images)) {
                    $msg['success'] = "Product created successfully";
                } else {
                    $msg['error'] = "Error encountered while creating product";
                }
            }

        }

        echo json_encode($msg);
    }


}