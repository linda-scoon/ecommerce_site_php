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
