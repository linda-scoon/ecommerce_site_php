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
 * @return void
 */
function add_basket($product_id, $quantity)
{
    if (isset($_SESSION['basket'])) {
        // since array index begins at 0, this shall provide the next empty slot in the array
        $num_products = count($_SESSION['basket']);
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
}

function update_basket($product_id, $quantity, $action)
{
    // finding product in basket and carrying out the requested action
    foreach ($_SESSION['basket'] as $key => $product) {
        if ($product_id === $product['id']) {
            if ($action == 'delete') {
                unset($_SESSION['basket'][$key]);
            } else if ($action == 'update') {
                $_SESSION['basket'][$key]['quantity'] == $quantity;
            }
        }
    }
}
