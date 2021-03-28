<?php
$page_title = 'Product Details';
require('includes/site_header.php');

// retrieving data from database
if (isset($_GET['product_id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);
    $products = retrieve_products($conn, $product_id);

    //if product does not exist
    if (empty($products)) {
        echo 'We do not have the product you are after. ' . '<a href="index.php">Return to home page</a>';
    } else {
?>
        <!-- if product exists -->
        <section class="row mt-5">
            <div class="col-lg-6 d-flex justify-content-center">
                <img src="<?= htmlspecialchars($products[0]['img_full']) ?>" alt="" class="img-fluid">
            </div>
            <div class="col-lg-6 mt-5">
                <h2><?= htmlspecialchars($products[0]['product_name']) ?></h2>
                <p class="multiline-text"><?= htmlspecialchars($products[0]['product_desc']) ?></p>
                <h4 class=""><?= '£' . htmlspecialchars($products[0]['price']) ?></h4>
                <form action="page_basket.php" method="post">
                    <div class="form-group">
                        <div class="d-flex flex-column">
                            <label for="quantity">Select Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="w-25" min="1" max="100" required>
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($products[0]['product_id']) ?>">
                            <input type="submit" value="Add to Basket" class="btn btn-lg btn-outline-success mt-3 me-auto">
                        </div>
                    </div>
                </form>
            </div>
        </section>
<?php }
} else { // if product id is not given
    echo 'No products to display';
}
require('includes/site_footer.php');
?>