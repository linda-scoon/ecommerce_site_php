<?php
$page_title = 'Registration';
require('includes/site_header.php');

if (isset($_SESSION['user'])) {
    $_SESSION['state_msg'] = "You are already logged in";
    header("Location: page_profile.php");
}
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$email = $_POST['email'] ?? '';
$msg = '';

if (!empty($_POST)) {

    if (!isavailable_email($conn, $_POST['email'])) {
        $msg = '<div class="text-danger fw-bolder row d-flex justify-content-center mt-5">This email already exists please go to login</div>';
    } else if ($_POST['password1'] !== $_POST['password2']) {
        $msg = '<div class="text-danger fw-bolder row d-flex justify-content-center mt-5">Passwords don\'t match</div>';
    } else {
        if (add_user($conn, $email, $fname, $lname, $_POST['password1'])) {
            if (isverified_login($conn, $email, $_POST['password1'])) {
                $_SESSION['state_msg'] = 'You have successfully registered and are now logged in';
                redirect();
            }
        }
    }
}

// display err/success message
echo $msg;
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="row mt-5 mx-auto">
    <div class="form-group col-lg-6 offset-lg-3 border p-5">
        <h4>Sign Up</h4>
        <label for="fname">First Name</label>
        <input name="fname" value="<?= htmlspecialchars($fname) ?>" type="text" id="fname" pattern="^[a-zA-Z]+$" title="name has to only be in letters" class="form-control" maxlength="20" required>
        <label for="lname">Last Name</label>
        <input name="lname" value="<?= htmlspecialchars($lname) ?>" type="text" id="lname" pattern="^[a-zA-Z]+$" title="name has to only be in letters" class="form-control" maxlength="20" required>
        <label for="email">Email</label>
        <input name="email" value="<?= htmlspecialchars($email) ?>" type="email" id="email" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" placeholder="email@example.com" title="please enter a valid email" class="form-control" required>
        <label for="password1">Password</label>
        <input name="password1" type="password" id="password1" class="form-control" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,20}$" title="password needs to have atleast 
1 lowercase letter 
1 digit 
1 uppercase letter and 
be between 6-20 characters long" required>
        <label for="password2">Confirm Password</label>
        <input name="password2" type="password" id="password2" class="form-control" maxlength="20" required>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
            <label class="form-check-label" for="terms">
                Accept <a href="">Terms and conditions </a>
            </label>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-outline-primary mt-3">
        <p>Already a member? <a href="page_login.php">Sign in</a></p>
    </div>
</form>

<?php require('includes/site_footer.php');
?>