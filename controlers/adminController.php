<?php 
require "../database/connect.php";
$errors = array();
$info = array();

//########  LOGIN ADMIN   #########
// if (isset($_POST["login-admin"])) {
//     $username = mysqli_real_escape_string($conn, $_POST['username']);
//     $password= mysqli_real_escape_string($conn, $_POST['password']);

//     $username_Select = "SELECT * FROM admin WHERE admin_name = '$username'";
//     $username_Check = mysqli_query($conn, $username_Select);
//     if (mysqli_num_rows($username_Check) >0) {
//         $fetch = mysqli_fetch_assoc($username_Check);
//         $fetch_pass = $fetch['admin_password'];
//         if($password === $fetch_pass) {
           
//             header("location: ../admin/admin.php");
//             }
//         } 
            
// }

//########  ADD ELECTION   #########

 if (isset($_POST["add-election"])) {
    $election_id = mysqli_real_escape_string($conn, $_POST['electionNo']);
    $election_title = mysqli_real_escape_string($conn, $_POST['election_title']);
    $starting_time = mysqli_real_escape_string($conn, $_POST['starting_time']);
    $ending_time = mysqli_real_escape_string($conn, $_POST['ending_time']);
   // $election_status = "active";

    $check_election = "SELECT * FROM election WHERE election_id ='$election_id'";
    $check_res = mysqli_query($conn, $check_election);
    $result_row = mysqli_num_rows($check_res);

    if ($result_row > 0) {
        $errors['elction_id'] = "Election Already Exists!";
    }
//check election date
    $starting_date_entered = date_create($starting_time);
    $ending_date_entered = date_create($ending_time);

    $diff = date_diff($ending_date_entered,$starting_date_entered );

    if ($diff) {
        echo "active";
    } else {
        $election_status = "ended";
    }

    if ($starting_date_entered > $ending_date_entered) {
        $election_status = "ended";
        $errors['futureDate'] = "Invalide Ending time Date!";
    } else{
        $election_status = "active";
    }
//check election time
    $current_date = date('Y-m-d H:i:s');
    $current_dateString = date_create($current_date);
    if ($current_dateString > $starting_date_entered) {
        $election_status = "ended";
        $errors['pastDate'] = "Invalide Date! Enter date past current date";
    } else {
        $election_status = "active";
    }
    if (count($errors) === 0) {
        mysqli_query($conn, "INSERT INTO election(election_id, election_title, starting_time, ending_time, election_status)
        VALUES('$election_id', '$election_title', '$starting_time ', ' $ending_time', '$election_status')")
        or die(mysqli_error($conn));
        $info = "Your Account Was Created Successfuly!";
    }

 }

 //####### UPDATE ELECTION #########
 
 if (isset($_POST['update-election'])) {
        $id = $_POST['id'];
        $election_title = $_POST['election_title'];
        $status = $_POST['status'];
        $starting_time = $_POST['starting_time'];
        $ending_time = $_POST['ending_time'];
     
        $update = "UPDATE election SET election_title ='$election_title', starting_time='$starting_time',ending_time=' $ending_time', election_status='$status'  WHERE election_id = '$id'";
        $instQuery = mysqli_query($conn, $update);
        if (!$instQuery) {
            echo "not inserted:" .mysqli_error($conn);
            exit;
        } else {
            header("location: ../admin/election.php");
        }
}
if (isset($_POST['deleteBtn'])) {
        $electionId = $_POST['electionId'] ?? null;

        if (!$electionId) {
            header('Location: delete.php');
            exit;
        } else {
          $delete  = "DELETE FROM election WHERE election_id = '$electionId'";
          $deleteQuery = mysqli_query($conn, $delete);

          if($deleteQuery){
            header('Location: election.php');
          }
            
        }
}


 //####### CREATE NEW CANDIDATE #########

 if (isset($_POST["add-candidate"])) {
        $candidate_name = mysqli_real_escape_string($conn, $_POST['candidate_name']);
        $election_id = mysqli_real_escape_string($conn, $_POST['electionNo']);
        $voternumber = mysqli_real_escape_string($conn, $_POST['voternumber']);
        $position = "";

        $check_election = "SELECT * FROM election WHERE election_id ='$election_id'";
        $check_res = mysqli_query($conn, $check_election);
        $result_row = mysqli_num_rows($check_res);
        $fetchPostion = mysqli_fetch_assoc($check_res);
        $position = $fetchPostion['election_title'];
    

        if ($result_row < 0) {
            $errors['null_election__id'] = "Election Do Not Exists! Please Add Election First";
        } 

        $check_cand = "SELECT * FROM candidates WHERE voternumber = '$voternumber' AND election_id = '$election_id'";
        $check_resp = mysqli_query($conn, $check_cand);
        $result_row = mysqli_num_rows($check_resp);
        

        if ($result_row > 0) {
            $errors['cand'] = "Candidate Already Exists!";
            //echo $result_row;
        }

        $image = $_FILES['cand_photo'] ?? null;
        $imagePath = '';
        if (!is_dir('../assets/images')) {
            $errors['img'] ="image targed folder not found!";
        }


        if (count($errors) == 0) {
            //add candidate image
            function randomString($n)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $str = '';
                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $str .= $characters[$index];
                }

                return $str;
            }

            if ($image && $image['tmp_name']) {
                $imagePath = '../assets/images/' . randomString(8) . '/' . $image['name'];
                mkdir(dirname($imagePath));
                move_uploaded_file($image['tmp_name'], $imagePath);
            }
            
            mysqli_query($conn, "INSERT INTO candidates(candidate_name, cand_photo, election_id, voternumber, position)
            VALUES('$candidate_name', '$imagePath', '$election_id', ' $voternumber', ' $position')")
            or die(mysqli_error($conn));
            $info = "Candidate added Successful!";
        }
}
?>
