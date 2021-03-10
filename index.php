<!-- homepage product display-->
<?php
$page_title = 'Product Listings';
require('includes/site_header.php');
$num_cols = 4;

// retrieving data from database
$query = 'SELECT * FROM products';
$products = db_fetch($conn, $query);

//calculating number of columns
$num_rows = sizeof($products) / $num_cols;

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
            $product = $products[$counter++];
            ?>
            <div class="card col m-1">
                <a href="page_product_details.php?product_id=<?=$product['product_id']?>">
                    <img class="card-img-top" src="<?= htmlspecialchars($product['img_thumb']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                        <p class=""><?= '£' . htmlspecialchars($product['price']) ?></p>
                    </div>
                </a>
            </div>
        <?php
        } ?>
    </section>
<?php
} ?>
<?php require('includes/site_footer.php'); ?>