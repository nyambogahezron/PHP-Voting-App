<?php require_once "../controlers/adminController.php"; ?>
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
      <div class="elction-header col-12">
        <span>Candidate</span>
        <button class="btn btn-sm btn-outline-secondary modal-btn">Add Candidate</button>
      </div>
        <div class="container mt-1">
          <div class="section-container mt-3 ">
            <table class="table table-striped-columns">
                <thead class="table-primary">
                  <tr>
                    <th class="table-danger" scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Candidate Name</th>
                    <th scope="col">Voter Number</th>
                    <th scope="col">Election Number</th>
                    <th scope="col">Position</th>
                    <th scope="col">Delete</th>
                   </tr>
                </thead>
                <tbody>
            <!--######## item start ######-->
              <?php
              $fetchingData = mysqli_query($conn, "SELECT * FROM candidates") or die(mysqli_error($conn)); 
              $isAnyCandidateAdded = mysqli_num_rows($fetchingData);

              if($isAnyCandidateAdded> 0){
                $row_number = 1;
                  while($row = mysqli_fetch_assoc($fetchingData))
                            {
                                $election_id = $row['election_id'];
              ?>
                  <tr>
                    <th scope="row"><?php echo $row_number++; ?></th>
                    <td><img class="cand-photo" src="<?php echo $row['cand_photo']; ?>" alt="candidate image" srcset=""></td>
                    <td><?php echo $row['candidate_name']; ?></td>
                    <td><?php echo $row['voternumber']; ?></td>
                    <td><?php echo $row['election_id']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td>
                    <form class="w-0" method="post" action="deleteInfo.php" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $row['voternumber']; ?>"/>
                    <button type="submit" class="deleteBtn btn btn-sm btn-outline-danger">Delete</button>
                </form>
                  </td>
                    
                  </tr>
                  <?php }
                  } else {
              ?>
                    <h2>no_candidate</h2>
                    <?php
                  }
                  ?>
              <!--######## item end ######-->

                </tbody>
              </table>
        </div>
    
    <?php if(count($errors) > 0){ ?>
         <div class="errorsMsg">
             <?php
             foreach($errors as $errorsItem){
               echo "<span class ='eItem'> $errorsItem</span>" .'<br>';
             }
             ?>
         </div>
             <?php
     }
   ?>

        </div>
    </header>

    <div class="modal-overlay">
      <div class="modal-container">
      <button class="close-btn"><i class="bi bi-x"></i></button>
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
                
            <button type="submit" name="add-candidate" class="mx-5 add-election btn btn-primary w-75 mb-3">Add Candidate</button>
        </form>
        
          </div>
    </div>
</main>

  <!--######  Main JS File ######-->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/app.js"></script>
  

</body>

</html>