<?php require_once "../controlers/user.php"; ?>
<?php //require_once "../controlers/adminController.php"; ?>

<?php
$email = $_SESSION['email'];
$user_name = ""; 
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
    header('Location: ../views/login.php');
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
        
            <span>VOTTING BALLOT </span>
        </div>
        <div class="back-nav">
            <div class="votelogo">
            <img class="logopic" src="../assets/images/logo.gif" alt="voted" srcset="">
            </div>
            <div class="username">User Account: <?php echo $fetch_username['username'];?></div>
            <ul>
                <li><a href="results.php">Results</a></li>
                <li><a href="logout.php"><i class="bi bi-box-arrow-in-right"></i> logout</a></li>
            </ul>

        </div>
        
   <div class="ballot-section mt-0">
      <?php
      $electionData = mysqli_query($conn, "SELECT * FROM election WHERE election_status = 'active'") or die(mysqli_error($conn)); 
      $electionrows = mysqli_num_rows($electionData);


      if($electionrows> 0) {

          while($row = mysqli_fetch_assoc($electionData)) {
                      $election_id = $row['election_id'];
                      $election_name = $row['election_title'];
        ?>
           <div class="result-title">
                <span class="mb-2"> ELECTION FOR <?php echo $election_name ."". "ID:" .$election_id ;?></span>
            </div>
            <div class="ballot mt-1">
            <table class="table table-striped-columns">
                
                <thead class="table-primary">
                  <tr>
                    <th class="table-danger" scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Candidate Name</th>
                    <th scope="col">Voter Number</th>
                    <th scope="col">vote</th>
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
                ?>
                    <tbody>
                   <tr>
                    <th scope="row"><?php echo $row_number++; ?></th>
                    <td><img class="cand-photo" src="<?php echo $row['cand_photo']; ?>" alt="candidate image" srcset=""></td>
                    <td><?php echo $row['candidate_name']; ?></td>
                    <td><?php echo $row['voternumber']; ?></td>
                    <td>
                    <?php
                      $checkIfUserAsVoted = mysqli_query($conn, "SELECT * FROM ballot WHERE voternumber ='$voternumber' AND election_id = '$election_id'") or die(mysqli_error($conn));
                      $checkIfUserAsVotedRes = mysqli_num_rows($checkIfUserAsVoted);
                      ?>
                     
                    <form class="w-0" method="post" action="../admin/add_vote.php" style="display: inline-block">
                        <input  type="hidden" name="election_id" value="<?php echo $row['election_id'];  ?>"/>
                        <input  type="hidden" name="voter-no" value="<?php echo $_SESSION['email']; ?>"/>
                        <input  type="hidden" name="cand-no" value="<?php echo $row['voternumber']; ?>"/>
                        <?php if($checkIfUserAsVotedRes == 0):?>
                        <button type="submit" class="btn btn-sm btn-primary">vote</button>
                        <?php endif ;?>

                        <?php if($checkIfUserAsVotedRes !== 0):?>
                        <img class="cand-photo" src="../assets/images/vote.png" alt="voted" srcset="">                      
                        <?php endif ;?>
                    </form>                        
                  </td>
                  </tr>
                 <!--######## item end ######-->

                </tbody>
                <?php }?>
              </table>
           
        </div>
      
        <?php }?>
        <?php } ?>
        <?php } ?>
     </div>
    <script src="votes.js"></script>
</body>
</html>
