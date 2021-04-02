<?php

/**
 * validates images and saves to directory
 *
 * @param object $img
 * @param string $type 'thumbnail or full image'
 * @return int 1. upload error 2.file type 3. size error 4. dimensions error 0. success
 */
function process_img($img, $type)
{
    $valid_ext = array('jpg', 'jpeg', 'png', 'jfif');
    $set_size = ($type == 'thumbnail') ? 500000 : 1000000000;
    $set_width = ($type == 'thumbnail') ? 300 : 600;
    $set_height = ($type == 'thumbnail') ? 300 : 400;

    // converting to lowercase, removing spaces and extracting file extension
    $img_name = strtolower($img['name']);
    str_replace(" ", "-", $img_name);
    $img_name = explode('.', $img_name);

    if ($img['error'] != 0 && $img['error'] != 2) { #errors
        return 1;
    } elseif (!in_array($img_name[1], $valid_ext)) { #file type
        return 2;
    } elseif ($img['size'] > $set_size || $img['error'] == 2) { #size
        return 3;
    } elseif (getimagesize($img['tmp_name'])[0] > $set_width || getimagesize($img['tmp_name'])[1] > $set_height) { #dimensions
        return 4;
    } else {
        //save images to file with unique name
        $new_img_name = $img_name[0] . date('Y-m-d-H-i-s') . ".".$img_name[count($img_name)-1];
        print_r($new_img_name);
        // move_uploaded_file($img["tmp_name"], "/img/products/" . "." . $new_img_name);
        return 0;
    }
}
