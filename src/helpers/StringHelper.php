<?php

class StringHelper {

    public function changeFileName($file_name) {
        $new_file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name);
        $file_name_ext =  pathinfo($file_name, PATHINFO_EXTENSION);
        return $new_file_name . time() . ".". $file_name_ext;
    }
}