<?php
$page_title = 'Login';
require('includes/site_header.php');

if (isset($_SESSION['user'])) {
    $_SESSION['state_msg'] = "You are already logged in";
    header("Location: index.php");
}

// verifying login
$email = isset($_POST['email']) ? $_POST['email'] : '';
$msg = '';

if (isset($_POST['submit'])) {
    $password = $_POST['password'];

    if (isverified_login($conn, $_POST['email'], $_POST['password'])) {
        $_SESSION['state_msg'] = 'You are successfully logged in';
        redirect();
    } else {
        $msg = 'Please enter a valid login';
    }
}

?>
<!-- display err/success message -->
<div class="text-danger fw-bolder row d-flex justify-content-center mt-5"><?= $msg ?></div>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="row mt-5 mx-auto">
    <div class="form-group col-lg-6 offset-lg-3 border p-5">
        <h4>Sign In</h4>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" id="email" class="form-control" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <input type="submit" value="Submit" name="submit" class="btn btn-outline-primary mt-3">
        <p>Not yet a memeber? <a href="page_registration.php">Sign up</a></p>
    </div>
</form>
<?php
require('includes/site_footer.php');
?>