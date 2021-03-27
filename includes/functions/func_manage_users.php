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
    $query = "SELECT email, user_password FROM users WHERE email ='" . $email . "';";
    $result = db_fetch($conn, $query);

    foreach ($result as $user) {
        if ($email === $user['email'] && $password === $user['user_password']) {
            $_SESSION['email'] = $user['email'];
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
    $password = mysqli_real_escape_string($conn, $password);

    $query = "INSERT INTO users (email, fname, lname, user_password) VALUES ('" . $email . "','" . $fname . "','" . $lname . "','" . $password . "');";

    if (db_insert($conn, $query)) {
        return false;
    }
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
