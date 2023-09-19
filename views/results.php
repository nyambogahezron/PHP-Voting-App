<?php require_once "../controlers/adminController.php"; ?>
<?php require_once "../controlers/user.php"; ?>
<?php
$email = $_SESSION['email'];
$voternumber = $_SESSION['voternumber'];
$info = array();

if($email != false && $voternumber != false){
    $select_user = "SELECT * FROM voters WHERE voternumber = '$voternumber'";
    $selected_row = mysqli_query($conn, $select_user);
    if($selected_row){
        $fetch_username = mysqli_fetch_assoc($selected_row);
        $user_name_sel = $fetch_username['username'];
              
    }
}else{
    header('Location: ../controlers/login.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../admin/layouts/header.php";?>
  
   <!--  Main CSS File -->
   <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>
    <div class="results-section">
        <div class="resut-header-title">
            <span>VOTTING RESULTS </span>
        </div>
        <div class="back-nav">
            <div class="votelogo">
            <img class="logopic" src="../assets/images/logo.gif" alt="voted" srcset="">
            </div>
            <div class="username">User Account: <?php echo $fetch_username['username'];?></div>
            <ul>
                <li><a href="ballot.php">Home</a></li>
                <li><a href="logout.php"><i class="bi bi-box-arrow-in-right"></i> logout</a></li>
            </ul>

        </div>
   <div class="ballot-section">
      <?php
      $electionData = mysqli_query($conn, "SELECT * FROM election WHERE election_status = 'active'") or die(mysqli_error($conn)); 
      $electionrows = mysqli_num_rows($electionData);
      ?>

      <?php if($electionrows> 0): ?>

          <?php while($row = mysqli_fetch_assoc($electionData)) {
                      $election_id = $row['election_id'];
                      $election_name = $row['election_title'];
            ?>
           <div class="result-title mx-0">
                <span class="mx-3"> RESULTS FOR <?php echo $election_name ."". "ID:" .$election_id ;?></span>
            </div>
            <div class="ballot mt-1">
            <table class="table table-striped-columns">
                
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
        <?php } ?>
        <?php endif; ?>

     </div>
    <script src="votes.js"></script>
</body>
</html>
