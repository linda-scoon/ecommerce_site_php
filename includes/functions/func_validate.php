<?php
/**
 * checks the users login and returns a boolean
 */
function verify_login($email, $password)
{
    $query = 'SELECT email, password FROM users WHERE email ==';
    $verified = false;
    // if ($email ===  && $password === ) {
    //    $verified = true;
    // }
    return $verified;
}
