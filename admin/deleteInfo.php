<?php require_once "../controlers/adminController.php"; ?>
<?php require_once "../controlers/adminLogin.php"; ?>
<?php 
$username = $_SESSION['admin'];
if(!$username){
    header("location: login.php?invalid-access");
}
?>

<?php require_once "../database/connect.php"; ?>
<?php

//delete candidate
$id = $_POST['id'] ?? null;
if (!$id) {
    header('Location: deleteInfo.php');
    exit;
} else {
    mysqli_query($conn, "DELETE FROM candidates WHERE voternumber = '$id'");
    header('Location: candidates.php');
}

//delete election
$electionId = $_POST['electionId'] ?? null;
if (!$electionId) {
    header('Location: deleteInfo.php');
    exit;
} else {
    mysqli_query($conn, "DELETE FROM election WHERE election_id = '$electionId'");
    header('Location: election.php');
}

