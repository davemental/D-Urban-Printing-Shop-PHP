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
        unset($_SESSION["user_name"]);
        header("location: " . APP_URL);
    }

    public function login(){

        $auth = $this->authenticated;

        if ($auth== 1) { // redirect to admin page if logged in
            header("location: ". APP_URL . "admin");
        }

        $this->loadView("pages/admin/admin-login", [
            "title" => "Account Login"
        ]);
    }

    public function loginRequest() {

        $msg = [];
        $user = new User();

        // redirect back to login page if access the url without data
        if (!isset($_POST["username"]) || empty($_POST["username"]) AND !isset($_POST["password"]) || empty($_POST["password"])) {
            header("Location: " . APP_URL . "admin-login");
        }

        if (!isset($_POST["username"]) || empty($_POST["username"])) {
            $msg['error'] = "Username is required";
        } else if (!isset($_POST["password"]) || empty($_POST["password"])) {
            $msg['error'] = "Password is required"; 
        } else {

            $username = $_POST["username"];
            $password = $_POST["password"];

            $user = $user->verifyLogin($username, $password);

            if ($user) {
                $msg['success'] = "Account successfully login ";
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;
            } else {
                $msg['error'] = "Error encountered! Account don't exist";
            }
        }
        echo json_encode($msg);
    }

    public function index() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $this->loadView("pages/partials/admin-header", [
            "title" => "Dashboard",
            "userName" => $_SESSION['user_name']
        ]);

        $visitor = new Visitors();

        $this->loadView("pages/admin/index", [
            "title" => "Dashboard",
            "visitorData" => $visitor->getAll()
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function products() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $this->loadView("pages/partials/admin-header", [
            "title" => "Product Management",
            "userName" => $_SESSION['user_name']
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

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

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

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }
        
        $this->loadView("pages/partials/admin-header", [
            "title" => "Create New Product",
            "userName" => $_SESSION['user_name']
        ]);

        $this->loadView("pages/admin/add-product", [
            "title" => "Create New Product",
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function createProduct() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $msg = [];
        $featureImgIsUploaded = false;
        $sampleImgIsUploaded = false;
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/D-URBAN/public/images/uploads/products/';

        $product = new Product();
        $string_helper = new StringHelper();

        if (!isset($_POST["title"]) || empty($_POST["title"])) {
            $msg['error'] = "Please enter a title";
        } else if (!isset($_POST["description"]) || empty($_POST["description"])) {
            $msg['error'] = "Please enter a Product Description";
        } else if (!isset($_FILES["featured_img"])) {
            $msg['error'] = "Please upload a featured image"; 
        } else {

            $title = $_POST["title"];
            $description = $_POST["description"];
            $featured_imgArr = $_FILES["featured_img"];
            $sample_imgArr = $_FILES["sample_img"] = isset($_FILES["sample_img"]) ? $_FILES["sample_img"] : [];
            $sample_images = [];

            // change file name for feature image
            $featured_img_file_name = $string_helper->changeFileName($featured_imgArr["name"][0]);

             //uploading featured images
            if (move_uploaded_file($featured_imgArr["tmp_name"][0], $uploadDir .  $featured_img_file_name)) {
                $featureImgIsUploaded = true;
            }

            $sample_imgs_str = "";

            // uploading sample images
            if (!empty(array_filter($sample_imgArr))) {

                for ($i = 0; $i < count($sample_imgArr["name"]); $i++) {

                    // change file name for sample images
                    $sImg_filename = $string_helper->changeFileName($sample_imgArr["name"][$i]);
                    if (move_uploaded_file($sample_imgArr["tmp_name"][$i], $uploadDir .  $sImg_filename)) {
                        $sampleImgIsUploaded = true;
                        $sample_images[] = $sImg_filename;
                    }
                }

                $sample_imgs_str = implode(", ", $sample_images);
            }

            if ($featureImgIsUploaded OR $sampleImgIsUploaded) {
                if ($product->create($title, $description, $featured_img_file_name, $sample_imgs_str)) {
                    $msg['success'] = "Product created successfully";
                } else {
                    $msg['error'] = "Error encountered while creating product";
                }
            }

        }
        echo json_encode($msg);
    }

    public function deleteProduct(){
        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

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
            
            //get all sample images if has for each id
            $sample_images = $product->getProductSampleImageById($ids[$i]);
            if (!$sample_images->sample_img === "" OR !empty($sample_images->sample_img)) {
                $sample_images = explode(', ', $sample_images->sample_img);

                foreach ($sample_images as $img) {
                    array_push($images, $file_directory . $img); // push also all the sample images
                }
            }
        }

         // delete all images that has stored in array
        foreach ($images as $img) {
            if (is_file($img)) {
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

    public function editProduct($id){
        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        // get product information from db
        $product = new Product();
        $productData = $product->getProductById($id[0]);

        $this->loadView("pages/partials/admin-header", [
            "title" => "Edit ". $productData->title,
            "userName" => $_SESSION['user_name']
        ]);

        $this->loadView("pages/admin/edit-product", [
            "title" => "Update ". $productData->title,
            "productData" => $productData
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function saveEditedProduct() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $msg = [];
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/D-URBAN/public/images/uploads/products/';
        
        $product = new Product();
        $string_helper = new StringHelper();

        if (!isset($_POST["title"]) || empty($_POST["title"])) {
            $msg['error'] = "Please enter a title";
        } else if (!isset($_POST["description"]) || empty($_POST["description"])) {
            $msg['error'] = "Please enter a Product Description";
        } else {

            $id = $_POST['id'];
            $title = $_POST["title"];
            $description = $_POST["description"];

            $featured_imgArr = $_FILES["featured_img"] = isset($_FILES["featured_img"]) ? $_FILES["featured_img"] : [];
            $sample_imgArr = $_FILES["sample_img"] = isset($_FILES["sample_img"]) ? $_FILES["sample_img"] : [];
            $sample_imgs_removedArr = $_POST["removed_sample_img"] = isset($_POST["removed_sample_img"]) ? $_POST["removed_sample_img"] : [];

            /** remove all list of sample images that has been remove in edit page */
            if (!empty(array_filter($sample_imgs_removedArr))) {
                $dbResults = $product->getProductSampleImageById($id); 
                $db_sample_imgsArr = explode(", ", $dbResults->sample_img); //list of sample images in db

                foreach($sample_imgs_removedArr as $img) {
                    if (($key = array_search($img, $db_sample_imgsArr)) !== false) {
                        unset($db_sample_imgsArr[$key]);
                    }
                }

                $result_update = $product->updateProductSampleImage($id, implode(", ", $db_sample_imgsArr));
                if ($result_update) { // delete all sample images in directory
                    foreach ($sample_imgs_removedArr as $img) {
                        if (is_file($uploadDir.$img)) {
                            unlink($uploadDir.$img);
                        }
                    }
                }
            }

            $featuredImgUpdated = false;
            $sampleImgUpdated = false;
            $fImgFilename = "";
            $sImgsFilename = [];

            if (!empty(array_filter($featured_imgArr))) { // upload new featured image to directory

                $file_name = $featured_imgArr["name"][0];
                $tmp_name = $featured_imgArr["tmp_name"][0];
                
                // change file name
                $fImgFilename = $string_helper->changeFileName($file_name);
                if  (move_uploaded_file($tmp_name, $uploadDir . $fImgFilename)) {
                    $featuredImgUpdated = true;
                }

                // remove the file in the directory for featured image
                $db_result = $product->getProductById($id);
                unlink($uploadDir.$db_result->featured_img);
            }

            if (!empty(array_filter($sample_imgArr))) { // upload new sample images to directory

                for ($i = 0; $i < count($sample_imgArr["name"]); $i++) {
                    $file_name = $sample_imgArr["name"][$i];
                    $tmp_name = $sample_imgArr["tmp_name"][$i];

                    $file_name = $string_helper->changeFileName($file_name);
                    if(move_uploaded_file($tmp_name, $uploadDir . $file_name)) {
                        $sampleImgUpdated = true;
                        $sImgsFilename[] = $file_name;
                    }
                }

                // get the previous sample images and add with the new ones
                $db_sample_imgs = $product->getProductSampleImageById($id);
                if (!empty( $db_sample_imgs->sample_img) OR  !$db_sample_imgs->sample_img === "") {
                    $db_sample_imgs = explode(", ", $db_sample_imgs->sample_img);
                    $sImgsFilename = array_merge($db_sample_imgs, $sImgsFilename);
                }
            }

            // update db
            $result = false;
            if ($featuredImgUpdated and $sampleImgUpdated) { // both featured and sampled images
                $result = $product->updateProduct($id, $title, $description, $fImgFilename, implode(", ", $sImgsFilename));
            } else if ($featuredImgUpdated) { // only featured image has been replace
                $result = $product->updateProductTitleDescriptionFimgs($id, $title, $description, $fImgFilename);
            } else if ($sampleImgUpdated) { // only sample images has been replace
                $result =$product->updateProductTitleDescriptionSimgs($id, $title, $description, implode(", ", $sImgsFilename));
            } else {
                $result = $product->updateProductTitleDescription($id, $title, $description);
            }

            if ($result) {
                $msg['success'] = "Product updated successfully";
            } else {
                $msg['error'] = "Error encountered while updating product";
            }
  
        }
    
        echo json_encode($msg);
    }

    public function imageCarousel() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $this->loadView("pages/partials/admin-header", [
            "title" => "Image Carousel Settings",
            "userName" => $_SESSION['user_name']
        ]);

        $imgCarousel = new imageCarousel();
        
        $this->loadView("pages/admin/image-carousel", [
            "title" => "Image Carousel Settings",
            "imgData" => $imgCarousel->getAllImage()
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function uploadImageCarousel(){

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $msg = [];
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/D-URBAN/public/images/carousel/';
        $img_carousel = new imageCarousel();
        $string_helper = new StringHelper();
        $fileIsUpdated = false;

        $img_carouselArr = $_FILES["img_carousel"] = isset($_FILES["img_carousel"]) ? $_FILES["img_carousel"] : [];
        $removed_imgsArr = $_POST["removed_img"] = isset($_POST["removed_img"]) ? $_POST["removed_img"] : [];

        if (empty(array_filter($removed_imgsArr)) and empty(array_filter($img_carouselArr))) {
            $msg['error'] = "Nothing to update";
        } else {

            /** remove all imgs in db and directory that has been remove in the DOM   */
            if (!empty(array_filter($removed_imgsArr))) {
                foreach($removed_imgsArr as $img) {
                    if ($img_carousel->deleteImageByName($img)) { // if remove the unlinked img
                        if (is_file($uploadDir.$img)) {
                            unlink($uploadDir.$img);
                            $fileIsUpdated = true;
                        }
                    }
                }
            }

            /** upload all new files  */
            if (!empty(array_filter($img_carouselArr))) { 

                for ($i = 0; $i < count($img_carouselArr["name"]); $i++) {

                    $file_name = $img_carouselArr["name"][$i];
                    $tmp_name = $img_carouselArr["tmp_name"][$i];
                    
                    // change file name
                    $imgFilename = $string_helper->changeFileName($file_name);

                    // upload and save to db
                    if  (move_uploaded_file($tmp_name, $uploadDir . $imgFilename)) {
                        if ($img_carousel->create($imgFilename, 1)) {
                            $fileIsUpdated = true;
                        }
                    }
                }
            }

            if ($fileIsUpdated) { 
                $msg['success'] = "Save successful";
            } else {
                $msg['error'] = "Error occurred saving the file";
            }
        }


        echo json_encode($msg);
    }

    public function request() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $quote = new Quote();
        
        $this->loadView("pages/partials/admin-header", [
            "title" => "Quote Received",
            "userName" => $_SESSION['user_name']
        ]);

        $this->loadView("pages/admin/request", [
            "title" => "Quote Received",
            "quoteData"=> $quote->getAllQuotes()
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function requestDetails($id) {
        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $quote = new Quote();
        if ($quote->findById($id[0])) {
            
            // change status to read
            $quote->updateStatusById($id[0]);
        }
        
        $this->loadView("pages/partials/admin-header", [
            "title" => "Request Details",
            "userName" => $_SESSION['user_name']
        ]);

        $this->loadView("pages/admin/request-details", [
            "title" => "Request Details",
            "quoteData"=> $quote->findById($id[0])
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function listenRequestReceived() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $quote = new Quote();

        // check for unread request received
        $unread_count = $quote->getRowUnreadRequest();
         echo json_encode($unread_count->rowCount);
    }

    public function searchQuoteRequest() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $quote = new Quote();
        $quoteData = [];

        if (!(isset($_POST['search_key'])) || !(empty($_POST['search_key']))) {

            $searchKey = $_POST['search_key'];
            $searchKey = preg_replace('/[^A-Za-z0-9\s]/', '', $searchKey); // clean the search key

            // search product name
            $quoteData = $quote->findAllByNameProduct($searchKey);
         }

         echo json_encode($quoteData);
    }

    public function deleteQuote() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $ids = $_POST['id'];
        $msg = [];
        $isDeleted = false;
        $file_directory = $_SERVER['DOCUMENT_ROOT'] . '/D-URBAN/public/quote-file/';


        $quote = new Quote();

        for ($i = 0; $i < count($ids); $i++) {

            /** get file name in db */
            $result = $quote->findById($ids[$i]);
            $file_name = $result->file_name;

            if (is_file($file_directory . $file_name)) {
                unlink($file_directory . $file_name);
            }
            
            if ($quote->deleteQuoteById($ids[$i])) {
                $isDeleted = true;
            }
        }

        if ($isDeleted) {
            $msg["success"] = "Delete successful";
        } else {
            $msg["error"] = "Encountered error while deleting the records";
        }

        echo json_encode($msg);
    }

    public function users() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $this->loadView("pages/partials/admin-header", [
            "title" => "Manage Users",
            "userName" => $_SESSION['user_name']
        ]);

        $user = new User();

        $this->loadView("pages/admin/manage-users", [
            "title"=> "Manage Users",
            "userData"=> $user->getAllUser()
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function createNewUserAccount(){

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $msg = [];
        $user = new User();

        if (!isset($_POST["username"]) || empty($_POST["username"])) {
            $msg['error'] = "Username is required";
        } else if (!isset($_POST["name"]) || empty($_POST["name"])) {
            $msg['error'] = "Name is required";
        } else if (!isset($_POST["email"]) || empty($_POST["email"])) {
            $msg['error'] = "Email is required"; 
        } else if (!isset($_POST["password"]) || empty($_POST["password"])) {
            $msg['error'] = "Password is required"; 
        } else {

            $username = $_POST["username"];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if ($user->create($username, $name, $email, $password)) {
                $msg['success'] = "Account successfully created";
            } else {
                $msg['error'] = "Error encountered while saving account";
            }
        }
        echo json_encode($msg);
        
    }

    public function userAccount() {

        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $this->loadView("pages/partials/admin-header", [
            "title" => "User Account",
            "userName" => $_SESSION['user_name']
        ]);

        $user = new User();
        $userData = $user->getUserById($_SESSION['user_id']);

        $this->loadView("pages/admin/user-account", [
            "title"=> "User Account",
            "userData"=> $userData
        ]);

        $this->loadView("pages/partials/admin-footer", []);
    }

    public function updateAccount() {
        
        // redirect to login page if not login
        if (!($_SESSION['user_id'] > 0)) {
            header("Location: " . APP_URL . "admin-login");
        }

        $msg = [];
        $user = new User();

        if (!isset($_POST["username"]) || empty($_POST["username"])) {
            $msg['error'] = "Username is required";
        } else if (!isset($_POST["name"]) || empty($_POST["name"])) {
            $msg['error'] = "Name is required";
        } else if (!isset($_POST["email"]) || empty($_POST["email"])) {
            $msg['error'] = "Email is required"; 
        } else if (!isset($_POST["password"]) || empty($_POST["password"])) {
            $msg['error'] = "Password is required"; 
        } else {

            $id = $_POST["id"];
            $username = $_POST["username"];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if ($user->update($username, $name, $email, $password, $id)) {
                $msg['success'] = "Account successfully";
            } else {
                $msg['error'] = "Error encountered while saving account";
            }
        }
        echo json_encode($msg);
    }

}