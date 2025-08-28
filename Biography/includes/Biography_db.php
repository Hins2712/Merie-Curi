<?php
function getConnection()
{
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "biography";
    $conn = new mysqli($server, $username, $password, $db);
    if (!$conn) {
        echo "unable to connect to db";
        return $conn;
    } else {
        return $conn;
    }
}?>


