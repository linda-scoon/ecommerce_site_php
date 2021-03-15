<?php
$page_title = 'Checkout';
require('includes/site_header.php');
?>
<h1 class="my-5">Checkout # of items</h1>
<form action="page_success.php" method="post">
    <section class="row mt-5">
        <div class="col-lg border p-5 m-2">
            <h4>Contact Information</h4>
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" pattern="^[a-zA-Z]+$" title="name has to only be in letters" class="form-control">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" pattern="^[a-zA-Z]+$" title="name has to only be in letters" class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" placeholder="email@example.com" title="please enter a valid email" class="form-control">
                <label for="tel">Phone</label>
                <input type="tel" name="tel" id="tel" class="form-control" required>
            </div>
        </div>
        <div class="col-lg border p-5 m-2">
            <h4>Shipping Information</h4>
            <div class="form-group">
                <label for="add1">Address line 1</label>
                <input type="text" name="add1" id="add1" class="form-control" required>
                <label for="add2">Address line 2</label>
                <input type="text" name="add2" id="add2" class="form-control">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" required>
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control" required>
                <label for="postcode">Postcode</label>
                <input type="text" name="postcode" id="postcode" class="form-control" required>
            </div>
            <label for="shipmethod">Shipping Method</label>
            <select name="shipmethod" id="shipmethod" class="form-control">
                <option selected>Select...</option>
                <option>Standard</option>
                <option>Express</option>
            </select>
        </div>
    </section>
    <section class="row">
        <div class="col border p-5 m-2">
            <h4>Payment Details</h4>
            <div class="form-group">
                <label for="paymethod">Payment Method</label>
                <select name="paymethod" id="paymethod" class="form-control">
                    <option selected>Select...</option>
                    <option>Visa</option>
                    <option>MasterCard</option>
                </select>
                <label for="cardnum">Card Number</label>
                <input type="text" name="cardnum" id="cardnum" class="form-control" required>
                <label for="cardholdername">Card-holder Name</label>
                <input type="text" name="cardholdername" id="cardholdername" class="form-control" required>
                <div class="d-flex">
                    <div class="form-group col-5 mx-1">
                        <label for="startdate">Start Date</label>
                        <input type="date" name="startdate" id="startdate" class="form-control">
                    </div>
                    <div class="form-group col-5 mx-1">
                        <label for="enddate">Expiry Date</label>
                        <input type="date" name="enddate" id="enddate" class="form-control" required>
                    </div>
                    <div class="form-group col-2 mx-1">
                        <label for="csc">CSC</label>
                        <input type="text" name="csc" id="csc" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg border p-5 m-2">
            <h4>Billing Address</h4>
            <div class="form-group">
                <label for="billadd1"></label>
                <input class="form-control" name="billadd1" id="billadd1" placeholder="Address line 1" type="text" required>
                <label for="billadd2"></label>
                <input class="form-control" name="billadd2" id="billadd2" placeholder="Address line 2" type="text">
                <label for="billcity"></label>
                <input class="form-control" name="billcity" id="billcity" placeholder="City" type="text" required>
                <label for="billcountry"></label>
                <input class="form-control" name="billcountry" id="billcountry" placeholder="Country" type="text" required>
                <label for="billpostcode"></label>
                <input class="form-control" name="billpostcode" id="billpostcode" placeholder="Postcode" type="text" required>
            </div>
        </div>
    </section>
    <section class="border overflow-auto orders p-2">CONFIRM ORDER</section>
    <section class="form-check col-xl-3 my-4">
        <input type="checkbox" id="terms" class="form-check-input">
        <label class="form-check-label" for="terms">
            Accept <a href="">Terms and conditions </a>
        </label>
    </section>
    <input type="submit" value="Place Order" class="btn btn-lg btn-outline-success ms-auto">
</form>

<?php require('includes/site_footer.php');
?>