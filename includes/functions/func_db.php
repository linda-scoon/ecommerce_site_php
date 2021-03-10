<?php

/**
 *  connects to the database and returns a database connection
 */
function db_connect($config)
{
    // getting credentials from the config file
    $db_config = $config['database'];
    @$conn = mysqli_connect($db_config['host'], $db_config['username'], $db_config['password'], $db_config['database']);

    //connection error check
    if (!$conn) {
        if (DEBUG) {
            die(mysqli_connect_error());
        } else {
            die('Oops something went wrong, please try again later');
        }
    }
    return $conn;
}

/**
 * queries the database and returns an array of results
 */
function db_fetch($conn, $query)
{
    $results = mysqli_query($conn, $query);

    //queries error check
    if (!$results) {
        if (DEBUG) {
            die(mysqli_error($conn));
        } else {
            die('Oops something went wrong, please try again later');
        }
    }

    $toReturn = array();
    while ($row = mysqli_fetch_assoc($results)) {
        $toReturn[] = $row;
    }
    return $toReturn;
}
