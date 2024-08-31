<?php
session_start();
if (isset($_SESSION['uniqueId'])) {
    include_once "database.php";

    $outgoingId = mysqli_real_escape_string($conn, $_POST['outgoing-id']);
    $incomingId = mysqli_real_escape_string($conn, $_POST['incoming-id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (!empty($message)) {
        $insertQuery = "INSERT INTO messages (incomingMsgId, outgoingMsgId, msg) VALUES ($incomingId, $outgoingId, '$message')";
        $insertResult = mysqli_query($conn, $insertQuery) or die();
        // echo $outgoingId . "\n";
        // echo $incomingId. "\n";
        // echo $message. "\n";
    }

} else {
    header("location: login.php");
}

?>