<?php
session_start();

if (isset($_SESSION['uniqueId'])) {
    include_once "database.php";
    $logoutId = mysqli_real_escape_string($conn, $_GET['logoutId']);
    if (isset($logoutId)) {
        $status = "Offline";
        $statusQuery = "UPDATE users SET status = '$status' WHERE uniqueId = {$logoutId}";
        $statusResult = mysqli_query($conn, $statusQuery);

        if ($statusResult) {
            session_unset();
            session_destroy();
            header("location: ../login.php");
        } else {
            header("location: ../users.php");
        }
    }

} else {
    header("location: ../login.php");
}

?>