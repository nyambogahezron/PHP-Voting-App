<?php require_once "../controlers/adminController.php"; ?>
<?php require_once "../controlers/adminLogin.php"; ?>
<?php 
$username = $_SESSION['admin'];
if(!$username){
    header("location: login.php?invalid-access");
}
?>
<?php
$id = $_GET['electionId'] ?? null;
$election_No="";
$election_name="";
$status="";
$starting_time="";
$ending_time="";

if ($id) {
    
    $electionData = mysqli_query($conn, "SELECT * FROM election WHERE election_id = '$id'") or die(mysqli_error($conn)); 
    $fetch = mysqli_fetch_assoc($electionData);

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
       <form action="election.php" method="post">
            <input  type="hidden" name="id" value="<?php echo $id ?>"/>
             <div class="input-field">
              <input type="text" value="<?php echo $election_name ?>" name="election_title" class="form-control" required/>
              <label>Election Name</label>
            </div>
            <div class="input-field">
              <input type="datetime" value="<?php echo $starting_time ?>" name="starting_time" class="form-control" required/>
              <label>Starting Time [Y-m-d h:i:s]</label>
            </div>
            <div class="input-field">
              <input type="datetime" value="<?php echo $ending_time ?>" name="ending_time" class="form-control" required/>
              <label>End Time [Y-m-d h:i:s]</label>
            </div>
            <div class="input-field">
              <input type="text" value="<?php echo $status ?>" name="status" class="form-control" required/>
              <label>election status</label>
            </div>
            
            <button type="submit" name="update-election" class="mx-3 add-election btn btn-primary w-100 mb-3">UPDATE ELECTION</button>
        </form>
        
          </div>
    </div>

      
</main>

  <!--######  Main JS File ######-->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/app.js"></script>
  

</body>

</html>