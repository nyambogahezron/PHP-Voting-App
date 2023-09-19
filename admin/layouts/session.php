<?php
require_once "../controlers/adminController.php";
$username = $_SESSION['admin'];
if(!$username){
    header("location: login.php?invalid-access");
}
?>