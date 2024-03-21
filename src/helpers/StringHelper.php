<?php

class StringHelper {

    public function changeFileName($file_name) {

        $file_name_ext =  pathinfo($file_name, PATHINFO_EXTENSION);

        //Lower case everything
        $file_name = strtolower($file_name);
        //Make alphanumeric (removes all other characters)
        $file_name = preg_replace("/[^a-z0-9_\s-]/", "", $file_name);
        //Clean up multiple dashes or whitespaces
        $file_name = preg_replace("/[\s-]+/", " ", $file_name);
        //Convert whitespaces and underscore to dash
        $file_name = preg_replace("/[\s_]/", "_", $file_name);

        return $file_name . time() . ".". $file_name_ext;
    }
}

// $string_helper = new StringHelper();
// echo $string_helper->changeFileName("Men Suit PNG Transparent, Men S Suits, Men, Suit, Cartoon PNG Image For Free Download_074144.jpg");