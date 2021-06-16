<?php

/**
 * validate images. Check image size, dimensions and file type
 * 
 * @param object $img
 * @param string $type 'thumbnail or full image'
 * @return int 1. size error 2.upload error 3. file type 4. dimensions error 0. success
 */
function validate_img($img, $type)
{
    $valid_ext = array('jpg', 'jpeg', 'png', 'jfif');
    $set_size = ($type == 'thumbnail') ? 500000 : 1000000000;
    $set_width = ($type == 'thumbnail') ? 500 : 2000;
    $set_height = ($type == 'thumbnail') ? 500 : 2000;

    //extracting file extension
    $ext = explode('.', $img['name']);

    if ($img['size'] > $set_size || $img['error'] == 1 || $img['error'] == 2) { #size
        return 1;
    } elseif ($img['error'] != 0) { #errors
        return 2;
    } elseif (!in_array($ext[count($ext) - 1], $valid_ext)) { #file type
        return 3;
    } elseif (getimagesize($img['tmp_name'])[0] > $set_width || getimagesize($img['tmp_name'])[1] > $set_height) { #dimensions
        return 4;
    }
    return 0; //all good
}

/**
 * remove spaces and dots and make name unique to avoid images being overwritten
 *
 * @param object $img
 * @return string new image name
 */
function process_imgname($img)
{
    // converting to lowercase, removing spaces and extracting file extension
    $name = strtolower($img['name']);
    $name = str_replace(" ", "_", $name);
    $name = explode('.', $name);

    $sliced_name = array_slice($name, 0, -1); //retrieving name - ext 
    $sliced_name = implode("_", $sliced_name); //making the array one word

    //give image a unique name & add last array element as the extension
    $new_name = $sliced_name . uniqid() . "." . $name[count($name) - 1];
    return $new_name;
}

/**
 * save image to file directory
 *
 * @param object $img
 * @param string $name
 * @return int error code 5. move file error 0. success
 */
function save_img($img, $name)
{
    if (move_uploaded_file($img["tmp_name"],  $_SERVER['DOCUMENT_ROOT'] . "/img/products/" . $name)) {
        return 0;
    } else { #move file
        return 5;
    }
}
