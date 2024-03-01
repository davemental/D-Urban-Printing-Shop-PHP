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

        $product = new Product();
        $allProducts = $product->getAllProducts();

        $this->loadView("pages/admin/manage-products", [
            "title" => "Product Management",
            "productData" => $allProducts
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }


    public function searchProduct() {

        $product = new Product();
        $productData = [];

        if (!(isset($_POST['product_key'])) || !(empty($_POST['product_key']))) {

            $productKey = $_POST['product_key'];
            $productKey = preg_replace('/[^A-Za-z0-9\s]/', '', $productKey); // clean the search key

            // search product name
            $productData["products"] = $product->getProductByName($productKey);
            $productData["app_url"] = APP_URL; 
         }

         echo json_encode($productData);
           
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

                    $sample_images != "" && $sample_images .= ", ";
                    $sample_images .= $sample_img_file_name_str;

                    $sampleImgIsUploaded = true;
                }
            }

            if ($featureImgIsUploaded AND $sampleImgIsUploaded) {
                if ($product->create($title, $description, $featured_img_file_name, $sample_images)) {
                    $msg['success'] = "Product created successfully";
                } else {
                    $msg['error'] = "Error encountered while creating product";
                }
            }

        }
        echo json_encode($msg);
    }


    public function deleteProduct(){

        $ids = $_POST['id'];
        $featured_imgs = $_POST['featured_img'];

        $msg = [];
        $images = [];
        $numDeleted = 0;
        $file_directory = $_SERVER['DOCUMENT_ROOT'] . '/D-URBAN/public/images/uploads/products/';

        $product = new Product();

        // get all images and save to array 
        for ($i = 0; $i < count($ids); $i++) {

            array_push($images, $file_directory . $featured_imgs[$i]); //push first the featured image
            
            //get all sample images for each id
            $sample_images = $product->getProductSampleImageById($ids[$i]);
            $sample_images = explode(', ', $sample_images->sample_img);

            foreach ($sample_images as $img) {
                array_push($images, $file_directory . $img); // push also all the sample images
            }
        }

         // delete all images that has stored in array
        foreach ($images as $img) {
            if (file_exists($img)) {
                unlink($img);
                $numDeleted += 1;
            }
        }

        // delete only if the count is matched
        if (count($images) === $numDeleted) {

            $status = false;
            foreach($ids as $id) {
              $status = $product->deleteProductById($id) ? true : false;
            }

            if ($status) {
                $msg["success"] = "Delete successful";
            } else {
                $msg["error"] = "Encountered error while deleting the product";
            }
            
        } else {
            $msg["error"] = "Encountered error while deleting the product";
        }

        echo json_encode($msg);
    }
}