<?php
$page_title = 'Product managment page';
require('includes/site_header.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    $_SESSION['state_msg'] = 'You don\'t have access to the requested page';
    header("Location: index.php");
}

//error messages
$msg_thumb = '';
$msg_full = '';
$msg = '';

//start validatation
$prod_name = $_POST['prod-name'] ?? '';
$price = $_POST['price'] ?? 2;
$desc = $_POST['desc'] ?? '';

$errors = array(
    -1 => 'No image has been selected',
    0 => '', //success
    1 => 'There has been an error uploading the image',
    2 => 'The file type is not allowed. Allowed file types are jpg & png',
    3 => 'The thumbnail image needs to be less than 500 kilobytes and the full image needs to be less than 1 megabyte',
    4 => 'The dimensions of the thumbnail need to be less than or equal to 300 x 300 pixels. The dimensions of the full image need to be less than or equal to 600 x 400 pixels',
);

if (isset($_POST['submit'])) {

    //validate post input




    $img_thumb = ($_FILES['img-thumb']['error'] == 4) ? null : $_FILES['img-thumb'];
    $img_full = ($_FILES['img-full']['error'] == 4) ? null : $_FILES['img-full'];

    //validate images. if image is set call validation function else set error code to -1
    $thumb_code = isset($img_thumb) ? process_img($img_thumb, 'thumbnail') :  -1;
    $full_code = isset($img_full) ? process_img($img_full, 'full') : -1;

    // //get error messages to display
    $msg_thumb = $errors[$thumb_code];
    $msg_full = $errors[$full_code];

    // // //add product to database if images have been successfully saved
    if ($thumb_code == 0 && $full_code == 0) {

        //set to default image if image has not been set for whatever reason
        $thumb = !empty($img_thumb['name']) ? $img_thumb['name'] : 'default-image.png';
        $full = !empty($img_full['name']) ? $img_full['name'] : 'default-image.png';

        $path = "img/products/";

        //Add product to database
        // if (add_products($conn, $prod_name, $price, $desc, $path . $thumb, $path . $full)) {
        //     $msg = 'The product has been successfully added';
        // } else {
        //     $msg = 'An error occured whilst try to add the product';
        // }
    }
}
?>

<h1 class="mt-5">Add Products</h1>
<div class="row d-flex justify-content-center text-success fw-bolder"><?= $msg ?></div>
<section class="mt-5">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 p-3"><label for="prod_name">Product Name</label>
                <input type="text" value="<?= htmlspecialchars($prod_name) ?>" name="prod-name" class="form-control" id="prod_name">
                <label for="price">Price</label>
                <input type="text" value="<?= htmlspecialchars($price) ?>" name="price" class="form-control" id="price">
                <label for="desc">Product Description</label>
                <textarea name="desc" class="form-control" class="form-control" id="desc" maxlength="100"><?= htmlspecialchars($desc) ?></textarea>
            </div>
            <div class="col-lg-6 p-3">
                <label for="img-thumb">Upload Thumbnail Image</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                <input type="file" name="img-thumb" class="form-control" id="img-thumb" accept="jpg, jpeg, jfif, png">
                <p class="text-danger"><?= $msg_thumb ?></p>
                <hr>
                <label for="img-full">Upload Full Image</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
                <input type="file" name="img-full" class="form-control" id="img-full" accept="jpg, jpeg, jfif, png">
                <p class="text-danger"><?= $msg_full ?></p>
            </div>
            <input type="submit" value="Add Product" name="submit" class="btn btn-primary col-3 mx-auto">
        </div>
    </form>
</section>
<h2 class="my-5">Update products</h2>

<h2 class="my-5">List of All Products</h2>

<?php

// retrieve and display all products
if ($products = retrieve_products($conn)) {

    // variable for label and input id's
    $id = 1;
    foreach ($products as $product) {
?>
        <section class="row mt-5">
            <div class="col-lg-3">
                <img src="<?= htmlspecialchars($product['img_thumb']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" class="img-thumbnail">
            </div>
            <div class="col-lg-5">
                <h4><?= htmlspecialchars($product['product_name']) ?></h4>
                <p class="multiline-text"><?= htmlspecialchars($product['product_desc']) ?></p>
                <h4>Price: <?= '£' . htmlspecialchars($products[0]['price']) ?></h4>
            </div>
        </section>
        <hr>
<?php
        $id++;
    }
}
?>
<?php
require('includes/site_footer.php');
