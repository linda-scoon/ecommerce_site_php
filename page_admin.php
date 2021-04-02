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
$color = 'danger';
$msg = '';

//start validatation
$max_desclen = 300;
$max_namelen = 40;
$pattern = '^([a-zA-Z0-9._ ]){4,40}$';
$prod_name = $_POST['prod-name'] ?? '';
$price = $_POST['price'] ?? 2.00;
$desc = $_POST['desc'] ?? '';

$errors = array(
    -1 => 'No image has been selected',
    0 => '', //success
    1 => 'The thumbnail image needs to be less than 500 kilobytes and the full image needs to be less than 1 megabyte',
    2 => 'There has been an error uploading the image',
    3 => 'The file type is not allowed. Allowed file types are jpg & png',
    4 => 'The dimensions of the thumbnail need to be less than or equal to 500 x 500 pixels. The dimensions of the full image need to be less than or equal to 2000 x 2000 pixels',
    5 => 'Error moving file. The file may not have been saved',
);

if (isset($_POST['submit'])) {

    //validate post input
    if (!preg_match("/$pattern/", $prod_name) && strlen($prod_name) > $max_namelen) {
        $msg = 'The product name does not meet requirements';
    } elseif (!is_numeric($price)) {
        $msg = 'price needs to be a number';
    } elseif (strlen($desc) > $max_desclen) {
        $msg = 'The description is too long';
    }
    //set variables if images have been selected
    $img_thumb = ($_FILES['img-thumb']['error'] == 4) ? null : $_FILES['img-thumb'];
    $img_full = ($_FILES['img-full']['error'] == 4) ? null : $_FILES['img-full'];

    // if image is set call validation function else set error code to -1
    $thumb_code = isset($img_thumb) ? validate_img($img_thumb, 'thumbnail') :  -1;
    $full_code = isset($img_full) ? validate_img($img_full, 'full') : -1;

    //add product to database if images have been successfully validated
    if ($thumb_code == 0 && $full_code == 0) {
        $path = "img/products/";

        //process image name or set to default image if image has not been set. I know its overkill but just incase
        $thumb_name = isset($img_thumb) ? process_imgname($img_thumb) :  'default-image.png';
        $full_name = isset($img_full) ? process_imgname($img_full) : 'default-image.png';

        //Add product to database
        if (add_products($conn, $prod_name, $price, $desc, $path . $thumb_name, $path . $full_name)) {
            $msg = 'The product has been successfully added';
            $color = 'success';

            //Once successfully added then save images to directory
            $thumb_code = save_img($img_thumb, $thumb_name);
            $full_code = save_img($img_full, $full_name);
        }
    }

    //get error messages to display
    $msg_thumb = $errors[$thumb_code];
    $msg_full = $errors[$full_code];
}
?>

<h1 class="mt-5">Add Products</h1>
<div class="row d-flex justify-content-center text-<?= $color ?> fw-bolder"><?= $msg ?></div>
<section class="mt-5">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 p-3">
                <label for="prod_name">Product Name</label>
                <input type="text" value="<?= htmlspecialchars($prod_name) ?>" name="prod-name" title="Only alphanumeric characters, spaces, '.' and '_' allowed. 4-40 characters" class="form-control" id="prod_name" pattern="<?= $pattern ?>" maxlength="<?= $max_namelen ?>" required>
                <label for="price">Price</label>
                <input type="text" value="<?= htmlspecialchars($price) ?>" name="price" title="Only numeric figures.Do not include the currency sign" class="form-control" id="price" maxlength="6" required>
                <label for="desc">Product Description</label>
                <textarea name="desc" class="form-control" title="maximum <?= $max_desclen ?> characters" class="form-control" id="desc" maxlength="<?= $max_desclen ?>"><?= htmlspecialchars($desc) ?></textarea>
            </div>
            <div class="col-lg-6 p-3">
                <label for="img-thumb">Upload Thumbnail Image</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                <input type="file" name="img-thumb" class="form-control" id="img-thumb" accept="jpg, jpeg, jfif, png" required>
                <p class="text-danger"><?= $msg_thumb ?></p>
                <hr>
                <label for="img-full">Upload Full Image</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
                <input type="file" name="img-full" class="form-control" id="img-full" accept="jpg, jpeg, jfif, png" required>
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
