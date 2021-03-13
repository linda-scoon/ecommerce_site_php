<?php
$page_title = 'Registration';
require('includes/site_header.php');
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="row mt-5 mx-auto">
    <div class="form-group col-lg-6 offset-lg-3 border p-5">
        <h4>Sign Up</h4>
        <label for="fname">First Name</label>
        <input name="fName" type="text" id="fname" class="form-control" maxlength="12" required>
        <label for="lname">Last Name</label>
        <input name="lName" type="text" id="lname" class="form-control" maxlength="12" required>
        <label for="email">Email</label>
        <input name="email" type="email" id="email" class="form-control" required>
        <label for="password1">Password</label>
        <input name="password1" type="text" id="password1" class="form-control" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,20}$" title="password needs to have atleast 
            1 lowercase letter 
            1 uppercase letter 
            1 special character and 
            be between 6-20 characters long" required>
        <label for="password2">Confirm Password</label>
        <input name="password2" type="password" id="password2" class="form-control" required>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="terms">
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