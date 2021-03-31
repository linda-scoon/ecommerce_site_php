<?php
$page_title = 'Profile';
require('includes/site_header.php');
$state_msg = $_SESSION['state_msg'] ?? '';

if (!isset($_SESSION['user'])) {
    header("Location: page_login.php");
}

?>
<div class="row d-flex justify-content-center text-info fw-bolder mt-4"><?= htmlspecialchars($state_msg) ?></div>
<h1 class="my-5">Profile Page</h1>
<section class="row border p-5 my-1">
    <h4>Hello <?= htmlspecialchars($_SESSION['user']['fname']) . ' ' . htmlspecialchars($_SESSION['user']['lname']) ?></h4>
    <div class="d-md-flex col m-1">
        <img src="img/products/default-image.png" alt="username" class="img-sm">
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
                <input name="fName" type="text" id="fname" value="<?= htmlspecialchars($_SESSION['user']['fname']) ?>" pattern="^[a-zA-Z]+$" title="name has to only be in letters" class="form-control" maxlength="20">
                <label for="lname">Last Name</label>
                <input name="lName" type="text" id="lname" value="<?= htmlspecialchars($_SESSION['user']['lname']) ?>" pattern="^[a-zA-Z]+$" title="name has to only be in letters" class="form-control" maxlength="20">
                <label for="email">Email</label>
                <input name="email" type="email" id="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" placeholder="email@example.com" title="please enter a valid email" class="form-control" required>
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
                <input name="newpass" type="password" id="newpass" class="form-control" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,20}$" title="password needs to have atleast 
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
unset($_SESSION['state_msg']);
require('includes/site_footer.php');
?>