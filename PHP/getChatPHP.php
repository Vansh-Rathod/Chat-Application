<?php
session_start();
if (isset($_SESSION['uniqueId'])) {
    include_once "database.php";

    $outgoingId = mysqli_real_escape_string($conn, $_POST['outgoing-id']);
    $incomingId = mysqli_real_escape_string($conn, $_POST['incoming-id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $output = "";

    $getMsgQuery = "SELECT * FROM messages 
                    LEFT JOIN users ON users.uniqueId = $incomingId
                    WHERE (outgoingMsgId = $outgoingId) AND (incomingMsgId = $incomingId) 
                    OR (outgoingMsgId = $incomingId) AND (incomingMsgId = $outgoingId)
                    ORDER BY msgId";
    $getMsgResult = mysqli_query($conn, $getMsgQuery);

    // making a different query to get the receiver image
    // $getImageQuery = "SELECT image FROM users WHERE uniqueId = $incomingId";
    // $getImageResult = mysqli_query($conn, $getImageQuery);
    // $imgRow = mysqli_fetch_assoc($getImageResult);

    if (mysqli_num_rows($getMsgResult) > 0) {
        while ($row = mysqli_fetch_assoc($getMsgResult)) {
            if ($row['outgoingMsgId'] === $outgoingId) { // it is a message sender
                $output .= '<div class="chat outgoing">
                                <div class="chat-details">
                                    <p class="message">' . $row['msg'] . '</p>
                                </div>
                            </div>';
            } else { // it is a message receiver
                $output .= '<div class="chat incoming">
                                <img src="PHP/User Images/' . $row['image'] . '" alt="profile image" class="user-friend-image" />
                                <div class="chat-details">
                                    <p class="message">' . $row['msg'] . '</p>
                                </div>
                            </div>';
            }
        }
        echo $output;
    }

} else {
    header("location: login.php");
}

?>