<?php
$page_title = 'Shopping Basket';
require('includes/site_header.php');

// session_destroy();
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    add_basket($_POST['product_id'], $_POST['quantity']);

    // redirecting to self inorder to prevent resubmission on refresh
    header("Location: page_basket.php");
}
?>
<h1 class="my-5">Shopping Basket</h1>
<hr>
<?php
$total = 0;
$num_items = 0;

// if the basket session variable has items loop through all items and display
if (isset($_SESSION['basket'])) {

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
                                <label for="<?= htmlspecialchars($products[0]['product_name']) ?>">Update Quantity</label>
                                <input type="number" name="update" value="<?= $product['quantity'] ?>" id="<?= htmlspecialchars($products[0]['product_name']) ?>" class="w-25" min="1" max="100">
                            </div>
                            <div class="col">
                                <input type="submit" value="Update" title="update product quantity" class="btn btn-warning mt-3 me-auto">
                                <a href="<?= $_SERVER['PHP_SELF'] . '?action=delete' ?>" class="text-danger">Delete</a>
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
        <button <?php if ($num_items == 0) { ?> disabled <?php } ?> class="btn btn-lg btn-success mt-md-5">Checkout</button>
    </div>
</section>
<?php require('includes/site_footer.php');
?>