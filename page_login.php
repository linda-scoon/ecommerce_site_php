<?php
$page_title = 'Login';
require('includes/site_header.php');

if (isset($_SESSION['email'])) {
    $_SESSION['state_msg'] = "You are already logged in";
    header("Location: index.php");
}

// verifying login
$msg = '';

if (!empty($_POST)) {
    $password = $_POST['password'];

    if (isverified_login($conn, $_POST['email'], $_POST['password'])) {
        // if the customer was about to checkout redirect them to checkout page else redirect to profile
        if ($_SESSION['checkout']) {
            header("Location: page_checkout.php");
        } else {
            header("Location: page_profile.php");
        }
    } else {
        $msg = '<div class="text-danger fw-bolder row d-flex justify-content-center mt-5">Please enter a valid login</div>';
    }
}

// display err/success message
echo $msg;
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="row mt-5 mx-auto">
    <div class="form-group col-lg-6 offset-lg-3 border p-5">
        <h4>Sign In</h4>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?? '' ?>" id="email" class="form-control" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <input type="submit" value="Submit" class="btn btn-outline-primary mt-3">
        <p>Not yet a memeber? <a href="page_registration.php">Sign up</a></p>
    </div>
</form>
<?php
require('includes/site_footer.php');
?>