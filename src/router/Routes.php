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
    "/add-product" => "AdminController@addProduct",
    "/create-add-product" => "AdminController@createProduct",
];