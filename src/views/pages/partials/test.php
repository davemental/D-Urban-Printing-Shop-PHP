<?php

$str = "change local database1709018019.jpg, 
275498305_3121219101540656_8490818009241285553_n1709018019.jpg, 
directory1709018019.jpg, 
IMG_20190803_1532121709018019.jpg, 
Slide1-11709018019.jpg";

$var = explode(",", $str);
foreach ($var as $item)  {
    echo $item . PHP_EOL;
    ;
}