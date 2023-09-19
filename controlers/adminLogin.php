<?php
 session_start();
?>
<?php 
require "../database/connect.php";

//########  LOGIN ADMIN   #########
if (isset($_POST["login-admin"])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password= mysqli_real_escape_string($conn, $_POST['password']);

    $username_Select = "SELECT * FROM admin WHERE admin_name = '$username'";
    $username_Check = mysqli_query($conn, $username_Select);
    if (mysqli_num_rows($username_Check) >0) {
        $fetch = mysqli_fetch_assoc($username_Check);
        $fetch_pass = $fetch['admin_password'];
        if($password === $fetch_pass) {
            $_SESSION['admin'] = $username;
            header("location: ../admin/admin.php");
            }
        } 
            
}