<?php

/**
 * retrieves products from the database
 *
 * @param int $product_id default = null
 * @param object $conn
 * @return associative array
 */
function retrieve_products($conn, $product_id = null)
{
    if (isset($product_id)) {
        $query = 'SELECT * FROM products WHERE product_id =' . (int)$product_id;
    } else {
        $query = 'SELECT * FROM products';
    }

    return db_fetch($conn, $query);
}

/**
 * update basket
 *
 * @param int $product_id
 * @param int $quantity
 * @return boolean $success
 */
function addto_basket($conn, $product_id, $quantity)
{
    $success = false;

    //validation
    //check that both quantity and id are integers
    if (is_numeric($product_id) && is_numeric($quantity)) {
        $products = retrieve_products($conn, $product_id);

        //check if product exists
        if (!empty($products)) {

            if (isset($_SESSION['basket'])) {
                //this shall provide the next empty slot in the basket array, I know its super hacky but it works
                //retrieving the maximum index in the array then adding 1 to it to get next available index
                //if basket is empty start from 0;
                $num_products = !empty($_SESSION['basket']) ? (max(array_keys($_SESSION['basket'], max($_SESSION['basket']))) + 1) : 0;
                $in_basket = false;

                // checking if the product is already in the basket
                foreach ($_SESSION['basket'] as $key => $product) {
                    if ($product_id === $product['id']) {
                        $_SESSION['basket'][$key]['quantity'] += $quantity;
                        $in_basket = true;
                    }
                }

                //if product is not in basket, add product to basket
                if (!$in_basket) {
                    $_SESSION['basket'][$num_products] = array(
                        'id' => $product_id,
                        'quantity' => $quantity
                    );
                }
            } else {
                $_SESSION['basket'][0] = array(
                    'id' => $product_id,
                    'quantity' => $quantity
                );
            }
            $success = true;
        }
    }
    return $success;
}

/**
 * updates product quantity in basket
 *
 * @param int $product_id
 * @param int $quantity
 * @return void
 */
function update_basket($product_id, $quantity)
{
    // finding product in basket and setting its quantity to the new quantity
    foreach ($_SESSION['basket'] as $key => $product) {
        if ($product_id === $product['id']) {
            $_SESSION['basket'][$key]['quantity'] = $quantity;
        }
    }
}

/**
 * adds products to database
 *
 * @param object $conn
 * @param string $prod_name
 * @param float $price
 * @param string $desc
 * @param string $img_thumb
 * @param string $img_full
 * @return boolean
 */
function add_products($conn, $prod_name, $price, $desc, $img_thumb, $img_full)
{
    //sanitising inputs
    $prod_name = mysqli_real_escape_string($conn, $prod_name);
    $price = (float) $price;
    $desc = mysqli_real_escape_string($conn, $desc);
    $img_thumb = mysqli_real_escape_string($conn, $img_thumb);
    $img_full = mysqli_real_escape_string($conn, $img_full);

    $query = "INSERT INTO users (product_name, price, procuct_desc, img_thumb. img_full) VALUES ('" . $prod_name . "','" . $price . "','" . $desc . "','" . $img_thumb . "','" . $img_full . "');";

    if (db_insert($conn, $query)) {
        return true;
    }
    return false;
}
