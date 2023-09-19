<?php
session_start();
require "../database/connect.php";
$errors = array();
$info = array();

    if (isset($_POST["sign-up-user"])) {
        $user_email = mysqli_real_escape_string($conn, $_POST['user-email']);
        $username = mysqli_real_escape_string($conn, $_POST['user-name']);
        $voternumber = mysqli_real_escape_string($conn, $_POST['voter-number']);
        $user_password = mysqli_real_escape_string($conn, $_POST['user-password']);
        $user_retype_password = mysqli_real_escape_string($conn, $_POST['re-enter-user-password']);
        $user_role = "Voter"; 

        //check password match
        if ($user_password !== $user_retype_password) {
            $errors['password'] = "Confirm password not matched!";
        } 

        //check email
        $email_check = "SELECT * FROM voters WHERE email = '$user_email'";
        $check_response = mysqli_query($conn, $email_check);
        if(mysqli_num_rows($check_response) > 0){
            $errors['email'] = "Email already exist!";
        }

        //check voter number
        $voterNo_check = "SELECT * FROM voters WHERE voternumber = '$voternumber'";
        $check_VoterNo_response = mysqli_query($conn, $voterNo_check);
        if(mysqli_num_rows($check_VoterNo_response) > 0){
            $errors['email'] = "Invalid Voter Number!";
        }

        //check errors and add clean data
        if(count($errors) === 0) {
           $encpass = password_hash($user_password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO voters(email, username, voternumber, password, user_role)
            VALUES('$user_email', '$username', '$voternumber', '$encpass', '$user_role')")
            or die(mysqli_error($conn));

            $_SESSION['email'] = $user_email;
            $_SESSION['voternumber'] = $voternumber; 

            $info = "Your Account Was Created Successfuly!";
            header("location: ballot.php");
        } 
          
    };
    

    //login user
    if (isset($_POST["login_user"])) {
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $password= mysqli_real_escape_string($conn, $_POST['user_password']);
        
        $username_Select = "SELECT * FROM voters WHERE username OR email = '$user_name'";
        $username_Check = mysqli_query($conn, $username_Select);

        if (mysqli_num_rows($username_Check) > 0) {
            $fetch = mysqli_fetch_assoc($username_Check);
            $fetch_pass = $fetch['password'];
            $fetch_User_email = $fetch['email'];
            $voterNumber = $fetch['voternumber'];
            $check_password = password_verify($password,$fetch_pass);
            if($check_password) {
                $_SESSION['email'] = $fetch_User_email;
                $_SESSION['voternumber'] = $voterNumber; 
                header("location: ballot.php");
            }
            if(!$check_password) {
                $errors['pass-user'] = "Invalid User Name or Password!";
                header("location: login.php?invalid-login");
            }
        } else {
            $errors['user'] = "Incorrect User, Create Acccount!";
            header("location: login.php?invalid-user");
        }
 
    };
 
  

    //when user click log in 
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
?>
        