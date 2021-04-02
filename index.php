<!-- homepage product display-->
<?php
$page_title = 'Product Listings';
require('includes/site_header.php');
$state_msg = $_SESSION['state_msg'] ?? '';
$num_cols = 4;

// retrieving data from database
$products = retrieve_products($conn);

//calculating number of columns
$num_rows = count($products) / $num_cols;
?>
<div class="row d-flex justify-content-center text-warning fw-bolder"><?= htmlspecialchars($state_msg) ?></div>
<?php
// product cards
$counter = 0;
for ($i = 0; $i < $num_rows; $i++) {
?>
    <section class="row mt-5">
        <?php
        for ($j = 0; $j < $num_cols; $j++) {

            if ($j == 2) { ?>
                <!-- Force next columns to break to new line before lg breakpoint -->
                <div class="w-100 d-lg-none d-block"></div>
            <?php
            }
            $product = $products[$counter++] ?? null;
            $prod_id = $product['product_id'] ?? '';
            $img_thumb = $product['img_thumb'] ?? '';
            $prod_name = $product['product_name'] ?? '';
            $price = $product['price'] ?? '';
            $currency_sign = isset($product['price']) ? '£' : '';

            ?>
            <div class="card col m-1">
                <a href="page_product_details.php?product_id=<?= urlencode($prod_id) ?>">
                    <img class="card-img-top img-sm" src="<?= htmlspecialchars($img_thumb) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($prod_name) ?></h5>
                        <p><?= $currency_sign . htmlspecialchars($price) ?></p>
                    </div>
                </a>
            </div>
        <?php
        } ?>
    </section>
<?php
}
// clearing the logged in message
unset($_SESSION['state_msg']);
require('includes/site_footer.php');
?>