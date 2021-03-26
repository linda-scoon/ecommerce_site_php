<?php

/**
 * checks the users login and returns a boolean
 */
function isverified_login($conn, $email, $password)
{
    $query = "SELECT email, user_password FROM users WHERE email ='" . $email . "';";
    $result = db_fetch($conn, $query);

    foreach ($result as $user) {
        if ($email === $user['email'] && $password === $user['user_password']) {
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
    $query = "INSERT INTO users (email, fname, lname, user_password) VALUES ('" . $email . "','" . $fname . "','" . $lname . "','" . $password . "');";

    if (db_insert($conn, $query)) {
        return false;
    }
}
