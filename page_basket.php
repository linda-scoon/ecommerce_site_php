<?php
$page_title = 'Shopping Basket';
require('includes/site_header.php');
$numOfRows = 3

?>
<h1 class="my-5">Shopping Basket</h1>
<hr>
<?php
for ($i = 0; $i < $numOfRows; $i++) {
?>
    <section class="row mt-5">
        <div class="col-lg-3">
            <img src="img/products/rimmel_red_thumb.jfif" alt="" class="img-thumbnail">
        </div>
        <div class="col-lg-5">
            <h4>Hot red Rimmel London nail varnish</h4>
            <form action="" method="post">
                <div class="form-group">
                    <div class="row">
                        <div class="col mt-3">
                            <label for="update<?= $i ?>">Update Quantity</label>
                            <input type="number" name="update<?= $i ?>" id="update<?= $i ?>" class="w-25" min="1" max="100">
                        </div>
                        <div class="col">
                            <input type="submit" value="Update" class="btn btn-warning mt-3 me-auto">
                            <a href="#" class="text-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col mt-3">
            <h4>Quantity * Price = Total</h4>
        </div>
    </section>
    <hr>
<?php
} ?>

<section class="row mt-3">
    <div class="col-lg-8 mb-2">
        <h2>Subtotal(# of items): Total Price</h2>
    </div>
    <div class="col">
        <a href="page_checkout.php" class="btn btn-lg btn-success">Checkout</a>
    </div>
</section>
<?php require('includes/site_footer.php');
?>