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
<?php include "layouts/header.php"; ?>
  
 </head>

<body>

  <!-- ======= Header ======= -->

  <?php include "layouts/nav-header.php";?>
 
  <!--####### End Header #########-->

  <?php include "layouts/aside-nav.php";?>

  <!-- ======= Sidebar ======= -->

  <!--####### End Sidebar #########-->

 <!--####### Main Start #########-->
 
<main id="main" class="main">
<section class=" mt-3 section">
<section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="bg-secondary card info-card sales-card">
               <div class="card-body">
                  <h5 class="card-title"><strong>Number Of Voters</strong></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6>14</h6>
                      </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-xxl-4 col-md-4">
              <div class="bg-primary card info-card sales-card">
               <div class="card-body">
                  <h5 class="card-title"><strong>Number Of Candidates</strong></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-list-task"></i>
                    </div>
                    <div class="ps-3">
                      <h6>15</h6>
                      </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="bg-success card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title"><strong>Active Elections </strong></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="ps-3">
                      <h6>2</h6>
                      </div>
                  </div>
                </div>

              </div>
              
            </div>
    <div class="mt-4 col-lg-12">
    <div class="bg-info card">
         <div class="card-body">
        <h5 class="card-title">Recent Activity <span>| <?php echo date('Y-m-d H:i:s') ;?></span></h5>

        <div class="activity">

          <div class="activity-item d-flex">
            <div class="activite-label">32 min</div>
            <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
            <div class="activity-content">
              Quia quae rerum <a href="#" class="fw-bold text-dark">New members</a> added
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">56 min</div>
            <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
            <div class="activity-content">
              invalid access at admin
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">2 hrs</div>
            <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
            <div class="activity-content">
              new access to admin panel
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">1 day</div>
            <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
            <div class="activity-content">
              Election <a href="#" class="fw-bold text-dark">started</a> 
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">2 days</div>
            <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
            <div class="activity-content">
              Candidates added to election 
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">4 weeks</div>
            <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
            <div class="activity-content">
              Election closed
            </div>
          </div><!-- End activity item-->

        </div>

      </div>
    </div>
            
           </div>
        </div>
 <!-- End Recent Activity -->

        
      </div>
    </section>

</div>
</section>

</main>
<!--####### End Main #########-->


<?php include "layouts/footer.php"; ?>

  
  <!--##### V JS Files #####-->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!--######  Main JS File ######-->
  <script src="assets/js/main.js"></script>

</body>

</html>