<?php 
$user = 'localhost';
$username = 'root';
$password = '';
$database = 'vottingApp';

    $conn = mysqli_connect($user, $username, $password, $database);
/*
    if (!$conn) {
        die ("connetion failed: " . mysqli_connect_error());
    } echo "connection seccessfull";
 */
?>