<?php

$routes = [
    "/" => "HomeController@index",
    "/products" => "HomeController@products",
    "/product-item" => "HomeController@productItems",
    "/get-a-quote" => "HomeController@getQuote",
    "/about-us" => "HomeController@aboutUs",
    "/faqs" => "HomeController@faqs",

    "/admin" => "AdminController@index",
    "/manage-products" => "AdminController@products",
    "/search-product" => "AdminController@searchProduct",
    "/add-product" => "AdminController@addProduct",
    "/create-add-product" => "AdminController@createProduct",
    "/delete-product"=> "AdminController@deleteProduct",
];