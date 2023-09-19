<?php require_once "../controlers/adminController.php"; ?>
<?php require_once "../controlers/adminLogin.php"; ?>
<?php 
$username = $_SESSION['admin'];
if(!$username){
    header("location: login.php?invalid-access");
}
?>
<?php
$id = $_GET['voternumber'] ?? null;
$candidate_name="";
$election_id="";
$voternumber ="";
$position ="";


if ($id) {
    $candidate_name = $_POST['candidate_name'];
    $election_id = $_POST['electionNo'];
    $voternumber =$_POST['voternumber'];
    $position = "";

    $check_election = "SELECT * FROM election WHERE election_id ='$election_id'";
    $check_res = mysqli_query($conn, $check_election);
    $result_row = mysqli_num_rows($check_res);

    if ($result_row < 0) {
        $errors['null_election__id'] = "Election Do Not Exists! Please Add Election First";
    } else {
        $fetchPostion = mysqli_fetch_assoc($check_res);
        $position = $fetchPostion['election_title'];
    }
     
    $check_cand = "SELECT * FROM candidates WHERE voternumber ='$voternumber'";
    $check_res = mysqli_query($conn, $check_cand);
    $result_row = mysqli_num_rows($check_res);

    if ($result_row > 0) {
        $errors['cand'] = "Candidate Already Exists!";
    }


    if (count($errors) === 0) {
        //add candidate image
        $image = $_FILES['cand_photo'] ?? null;
        $imagePath = '';
        if (!is_dir('../assets/images')) {
            $errors['img'] ="image targed folder not found!";
        }
    
        if ($image && $image['tmp_name']) {
            $imagePath = '../assets/images/' . $voternumber . '/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
        
   

        mysqli_query($conn, "INSERT INTO candidates(candidate_name, cand_photo, election_id, voternumber, position)
        VALUES('$candidate_name', '$imagePath', '$election_id', ' $voternumber', ' $position')")
        or die(mysqli_error($conn));
        $info = "Candidate added Successful!";
    }

    $election_No = $fetch['election_id'];
    $election_name = $fetch['election_title'];
    $status = $fetch['election_status'];
    $starting_time = $fetch['starting_time'];
    $ending_time = $fetch['ending_time'];


} else{
    header("location: election.php");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
<?php include "layouts/header.php"?>

  
 </head>
<body>
  
  <!-- ======= Header ======= -->

  <?php include "layouts/nav-header.php";?>
 
  <!--####### End Header #########-->

  <!-- ======= Sidebar ======= -->
  
  <?php include "layouts/aside-nav.php";?>

  <!--####### End Sidebar #########-->

 <!--####### Main Start #########-->
  
<main id="main" class="main">

    <div class="modal-edit">
<div class="title">
    <div class="col-12 bg-white" >update <span><?php echo $election_name?></span></div>
    </div>
    <form action="candidates.php" method="post" enctype="multipart/form-data">
      <div class="input-field">
              <input type="text"  name="candidate_name" class="form-control" required/>
              <label>Name</label>
            </div>
            <div class="input-field">
              <input type="file"  name="cand_photo" class="form-control" required/>
              <label>photo</label>
            </div>
      <div class="input-field">
              <input type="number" name="electionNo" class="form-control" required/>
              <label>Election Number</label>
            </div>
          <div class="input-field">
              <input type="number"  name="voternumber" class="form-control" required/>
              <label>Voter Number</label>
            </div>
                
            <button type="submit" name="update-candidate" class="mx-5 add-election btn btn-primary w-75 mb-3">Add Candidate</button>
        </form>
        
          </div>
    </div>

    
</main>

  <!--######  Main JS File ######-->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/app.js"></script>
  

</body>

</html>