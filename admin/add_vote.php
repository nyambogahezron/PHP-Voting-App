<?php require_once "../database/connect.php"; ?>
<?php


$voteremail = $_POST['voter-no'] ?? null;
$candidate_number = $_POST['cand-no'] ?? null;
$election_id = $_POST['election_id'] ?? null;

$username_Select =mysqli_query($conn, "SELECT * FROM voters WHERE email = '$voteremail'");
$fetch_user = mysqli_fetch_assoc($username_Select);
$user_voter_no = $fetch_user['voternumber'];

mysqli_query($conn, "INSERT INTO ballot(election_id, voternumber, candidate_number)
            VALUES('$election_id', '$user_voter_no', '$candidate_number')")
            or die(mysqli_error($conn));

header("location: ../controlers/ballot.php");           


