<?php
$page_title = 'Shopping Basket';
require('includes/site_header.php');
$msg = '';

// if product ID and quantity are set call add to basket method
if (isset($_GET['product_id']) && isset($_GET['quantity'])) {

    // adding product and checking if product has been successfully added
    if (addto_basket($conn, $_GET['product_id'], $_GET['quantity'])) {

        // redirecting to self inorder to prevent resubmission on refresh
        header("Location:".$_SERVER['PHP_SELF']);
    } else {
        $msg = "The product you are after is not available";
    }
}

// if update has been clicked call update function to update product in basket
if (isset($_POST['submit'])) {
    update_basket($_POST['product_id'], $_POST['quantity']);
}

// if delete has been clicked then remove the item from basket session array
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        unset($_SESSION['basket'][$_GET['key']]);
    }
}
?>
<div class="row d-flex justify-content-center text-warning fw-bolder"><?= htmlspecialchars($msg) ?></div>
<h1 class="my-5">Shopping Basket</h1>
<hr>
<?php
$total = 0;
$num_items = 0;

// if the basket session variable has items loop through all items and display
if (isset($_SESSION['basket'])) {

    // variable for label and input id's
    $id = 1;

    foreach ($_SESSION['basket'] as $key => $product) {
        $products = retrieve_products($conn, $product['id']);
        $cost = (float)($product['quantity'] * $products[0]['price']);
?>
        <section class="row mt-5">
            <div class="col-lg-3">
                <img src="<?= htmlspecialchars($products[0]['img_thumb']) ?>" alt="<?= htmlspecialchars($products[0]['product_name']) ?>" class="img-thumbnail">
            </div>
            <div class="col-lg-5">
                <h4><?= htmlspecialchars($products[0]['product_name']) ?></h4>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col mt-3">
                                <label for="<?= 'basket' . $id ?>">Update Quantity</label>
                                <input type="number" name="quantity" value="<?= $product['quantity'] ?>" id="<?= 'basket' . $id ?>" class="w-25" min="1" max="100" required>
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                            </div>
                            <div class="col">
                                <input type="submit" name="submit" value="Update" title="update product quantity" class="btn btn-warning mt-3 me-auto">
                                <a href="<?= $_SERVER['PHP_SELF'] . '?action=delete&key=' . urlencode($key) ?>" class="text-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col mt-3">
                <h4>Cost: <?= htmlspecialchars($product['quantity']) . ' @ £' . htmlspecialchars($products[0]['price']) . ' = £' . $cost ?></h4>
            </div>
        </section>
        <hr>
<?php
        $id++;

        // calculating total cost and number of items in the basket
        $total += $cost;
        $num_items += $product['quantity'];
    }
}
?>
<section class="row mt-3">
    <div class="col-lg-8 mb-2">
        <h2><?= $num_items ?> products in basket</h2>
        <h2>Total to pay = £<?= $total ?></h2>
    </div>
    <div class="col">
        <form action="page_checkout.php" method="post">
            <input type="submit" <?php if ($num_items == 0) { ?> disabled <?php } ?> value="Checkout" class="btn btn-lg btn-success mt-md-5">
        </form>
    </div>
</section>
<?php
require('includes/site_footer.php');
?>