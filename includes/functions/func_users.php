<?php

/**
 * verifies the users login and returns a boolean
 *
 * @param object $conn
 * @param string $email
 * @param string $password
 * @return boolean
 */
function isverified_login($conn, $email, $password)
{
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM users WHERE email ='" . $email . "';";
    $result = db_fetch($conn, $query);

    foreach ($result as $user) {
        if ($email === $user['email'] && password_verify($password, $user['user_password'])) {
            $_SESSION['user'] = array(
                'email' => $user['email'],
                'fname' => $user['fname'],
                'lname' => $user['lname'],
                'role' => $user['user_role']
            );
            return true;
        }
    }
    return false;
}

/**
 * checks if the provided email is already registered
 * @return boolean true if email is free
 */
function isavailable_email($conn, $email)
{
    // checking database for the existance of the email
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT email FROM users WHERE email ='" . $email . "';";
    $result = db_fetch($conn, $query);

    if (empty($result)) {
        return true;
    }
    return false;
}

/**
 * adds users to database
 *
 * @param object $conn
 * @param string $email
 * @param string $fname
 * @param string $lname
 * @param string $password
 * @return void if success false if failure
 */
function add_user($conn, $email, $fname, $lname, $password)
{
    //sanitising inputs
    $email = mysqli_real_escape_string($conn, $email);
    $fname = mysqli_real_escape_string($conn, $fname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, fname, lname, user_password) VALUES ('" . $email . "','" . $fname . "','" . $lname . "','" . $hash . "');";

    if (db_insert($conn, $query)) {
        return true;
    }
    return false;
}

/**
 * retrieves users from database
 *
 * @param object $conn
 * @param string $email
 * @return associative array
 */
function retrieve_user($conn, $email)
{
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM Users WHERE email='" . $email . "'";
    return db_fetch($conn, $query);
}

/**
 * redirects the user, if the user was about to checkout redirect them to checkout page else redirect to profile
 *
 * @return void
 */
function redirect()
{
    if ($_SESSION['checkout']) {
        header("Location: page_checkout.php");
    } else {
        header("Location: page_profile.php");
    }
}
