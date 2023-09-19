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
          <table class="table bg-white table-striped-columns">
                
                <thead class="table-primary">
                  <tr>
                    <th class="table-danger" scope="col">#</th>
                    <th scope="col">Voter Name</th>
                    <th scope="col">voter Email</th>
                    <th scope="col">Voter Number</th>
                    
                </tr>
                </thead>
                
            <!--######## item start ######-->
            <?php
            $fetchingData = mysqli_query($conn, "SELECT * FROM voters") or die(mysqli_error($conn)); 
            $isAnyVoterAdded = mysqli_num_rows($fetchingData);

              if($isAnyVoterAdded> 0){
                $row_number = 1;
                  while($row = mysqli_fetch_assoc($fetchingData)) {
                        $voternumber = $row['voternumber'];
                        
                ?>
                    <tbody>
                   <tr>
                    <th scope="row"><?php echo $row_number++; ?></th>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['voternumber']; ?></td>
                    </tr>
                 <!--######## item end ######-->

                </tbody>
                <?php }?>
              </table>
           
        </div>
      
        <?php }?>

 
</main>
<?php include "layouts/footer.php"; ?>



</body>

</html>