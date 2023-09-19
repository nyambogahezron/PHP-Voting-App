<?php 
require_once "../controlers/adminController.php"; ?>
<?php require_once "../controlers/adminLogin.php"; ?>
<?php 
$username = $_SESSION['admin'];
if(!$username){
    header("location: login.php?invalid-access");
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
 
      <?php
      $electionData = mysqli_query($conn, "SELECT * FROM election") or die(mysqli_error($conn)); 
      $electionrows = mysqli_num_rows($electionData);


      if($electionrows> 0) {

          while($row = mysqli_fetch_assoc($electionData)) {
                      $election_id = $row['election_id'];
                      $election_name = $row['election_title'];
        ?>
           <div class="result-title  bg-white col-12">
                <span class="mx-3"> RESULTS FOR <?php echo $election_name ."". "ID:" .$election_id ;?></span>
            </div>
            <div class="ballot mt-1">
            <table class="table bg-white table-striped-columns">
                
                <thead class="table-primary">
                  <tr>
                    <th class="table-danger" scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Candidate Name</th>
                    <th scope="col">Number Of Voters</th>
                    
                </tr>
                </thead>
                
            <!--######## item start ######-->
            <?php
            $fetchingData = mysqli_query($conn, "SELECT * FROM candidates WHERE election_id = $election_id") or die(mysqli_error($conn)); 
            $isAnyCandidateAdded = mysqli_num_rows($fetchingData);

              if($isAnyCandidateAdded> 0){
                $row_number = 1;
                  while($row = mysqli_fetch_assoc($fetchingData)) {
                        $election_id = $row['election_id'];
                        $candidateNo = $row['voternumber'];
                        $getVoter = mysqli_query($conn, "SELECT * FROM ballot WHERE election_id = '$election_id' AND candidate_number = '$candidateNo'");
                        $countElection = mysqli_num_rows($getVoter);
                ?>
                    <tbody>
                   <tr>
                    <th scope="row"><?php echo $row_number++; ?></th>
                    <td><img class="cand-photo" src="<?php echo $row['cand_photo']; ?>" alt="candidate image" srcset=""></td>
                    <td><?php echo $row['candidate_name']; ?></td>
                    <td><?php echo $countElection; ?></td>
                    </tr>
                 <!--######## item end ######-->

                </tbody>
                <?php }?>
              </table>
           
        </div>
      
        <?php }?>
        <?php }?>
        <?php } ?>
        <?php if($electionrows < 0): ?>
         <div class="col-12 bg-white">
          <h1>NO RESULTS AVAILABLE</h1>
         </div>
         <?php endif; ?>
          
 
</main>

  <!--######  Main JS File ######-->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/app.js"></script>
  

</body>

</html>       