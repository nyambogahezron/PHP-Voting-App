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
        <span>Elections</span>
        <button class="modal-btn">Add Election</button>
      </div>
        <div class="container mt-1">
          <div class="section-container mt-3 col-12">
            <table class="table table-striped-columns">
                <thead class="table-primary">
                  <tr>
                    <th class="table-danger" scope="col">#</th>
                    <th scope="col">Election Name</th>
                    <th scope="col">Election No.</th>
                    <th scope="col">Starting Time</th>
                    <th scope="col">Ending Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Edit</th>
                  </tr>
                </thead>
                <tbody>
            <!--######## item start ######-->
              <?php
              $fetchingData = mysqli_query($conn, "SELECT * FROM election") or die(mysqli_error($conn)); 
              $isAnyElectionAdded = mysqli_num_rows($fetchingData);

              if($isAnyElectionAdded > 0){
                $row_number = 1;
                  while($row = mysqli_fetch_assoc($fetchingData))
                            {
                                $election_id = $row['election_id'];
              ?>
                  <tr>
                    <th scope="row"><?php echo $row_number++; ?></th>
                    <td><?php echo $row['election_title']; ?></td>
                    <td><?php echo $row['election_id']; ?></td>
                    <td><?php echo $row['starting_time']; ?></td>
                    <td><?php echo $row['ending_time']; ?></td>
                    <td><?php echo $row['election_status']; ?></td>
                    <td>
                    <form class="w-0" method="get" action="deleteInfo.php" style="display: inline-block">
                    <input  type="hidden" name="electionId" value="<?php echo $row['election_id']; ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                    </td>
                    <td>
                    <form class="editform" method="get" action="update.php" style="display: inline-block">
                    <input  type="hidden" name="electionId" value="<?php echo $row['election_id']; ?>"/>
                    <button type="" class="modal-btn-edit btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-square"></i>Edit</button>
                    </form>
                     </td>
                  </tr>
                  <?php }
                  } else {
              ?>
                    <h2>no_election</h2>
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
      <form action="election.php" method="post">
      <div class="input-field">
         <input type="text" name="electionNo" class="form-control" required/>
              <label>Election Number</label>
            </div>
          <div class="input-field">
              <input type="text"  name="election_title" class="form-control" required/>
              <label>Election Name</label>
            </div>
            <div class="input-field">
              <input type="datetime"  name="starting_time" class="form-control" required/>
              <label>Starting Time [Y-m-d h:i:s]</label>
            </div>
            <div class="input-field">
              <input type="datetime"  name="ending_time" class="form-control" required/>
              <label>End Time [Y-m-d h:i:s]</label>
            </div>
            
            <button type="submit" name="add-election" class="mx-5 add-election btn btn-primary w-75 mb-3">ADD POLL</button>
        </form>
        
          </div>
    </div>
    
</main>

  <!--######  Main JS File ######-->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/app.js"></script>
  

</body>

</html>