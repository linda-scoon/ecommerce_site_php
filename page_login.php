<?php
$page_title = 'Login';
require('includes/site_header.php');

// verifying login
$email = '';
$msg = '';
$loggedin = false;

if (!empty($_POST)) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $loggedin = isverified_login($conn, $email, $password);

    if ($loggedin) {
        $msg = '<p class="text-success err-text mt-5 fw-bolder">You have successfully logged in</p>';
    } else {
        $msg = '<p class="text-danger err-text mt-5 fw-bolder">Please enter a valid login</p>';
    }
}

// display err/success message
echo $msg;

if (!$loggedin) { ?>
    <!-- not logged in -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="row mt-5 mx-auto">
        <div class="form-group col-lg-6 offset-lg-3 border p-5">
            <h4>Sign In</h4>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" id="email" class="form-control" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <input type="submit" value="Submit" class="btn btn-outline-primary mt-3">
            <p>Not yet a memeber? <a href="page_registration.php">Sign up</a></p>
        </div>
    </form>
<?php
} else { ?>
    <!-- logged in -->
    <h1 class="my-5">Profile Page</h1>
    <section class="row border p-5 my-1">
        <h4>Hello Username</h4>
        <div class="d-md-flex col m-1">
            <img src="img/products/aila.svg" alt="username" class="img-sm">
            <span class="m-2">
                <p>Name</p>
                <p>Address</p>
            </span>
        </div>
        <div class="col">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group ">
                    <h4>Update profile picture</h4>
                    <input type="file" name="profile_pic" id="profile_pic">
                    <input type="submit" name="submit" value="Upload Image" class="btn-primary mt-3 me-auto">
                </div>
            </form>
        </div>
    </section>
    <section class="row">
        <div class="col p-5 border m-1">
            <h4>Update Personal Details</h4>
            <form action="" method="post">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input name="fName" type="text" id="fname" class="form-control" maxlength="20" required>
                    <label for="lname">Last Name</label>
                    <input name="lName" type="text" id="lname" class="form-control" maxlength="20" required>
                    <label for="email">Email</label>
                    <input name="email" type="email" id="email" class="form-control" required>
                    <label for="password">Password</label>
                    <input name="password" type="password" id="password" class="form-control" maxlength="20" required>
                    <input value="Submit" class="btn btn-outline-primary mt-3" type="submit">
                </div>
            </form>
        </div>
        <div class="col p-5 border m-1">
            <h4>Change Password</h4>
            <form action="" method="post">
                <div class="form-group"><label for="oldpass">Old Password</label>
                    <input name="oldpass" type="password" id="oldpass" class="form-control" maxlength="20" required>
                    <label for="newpass">New Password</label>
                    <input name="newpass" type="text" id="newpass" class="form-control" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,20}$" title="password needs to have atleast 
1 lowercase letter
1 digit 
1 uppercase letter and 
be between 6-20 characters long" required>
                    <label for="password2">Confirm New Password</label>
                    <input name="password2" type="password" id="password2" class="form-control" maxlength="20" required>
                    <input value="Submit" class="btn btn-outline-primary mt-3" type="submit">
                </div>
            </form>
        </div>
    </section>
    <section class="p-5 border m-1 overflow-auto orders">
        <h4>Orders</h4>

    </section>
<?php
}
require('includes/site_footer.php');
?>