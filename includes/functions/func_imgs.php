<?php

function process_img($img, $type)
{
    $set_size = ($type == 'thumbnail') ? 1000 : 2000;
    $set_width = ($type == 'thumbnail') ? 100 : 100;
    $set_height = ($type == 'thumbnail') ? 100 : 100;

    if ($img['error'] != 0) { #errors
        return 1;
    } elseif ($img['size'] > $set_size) { #size
        return 2;
    } elseif (getimagesize($img['tmp_name'])[0] > $set_width || getimagesize($img['tmp_name']) > $set_height) { #dimensions
        return 3;
    } else {
        //save images to file

        return 0;
    }
}
