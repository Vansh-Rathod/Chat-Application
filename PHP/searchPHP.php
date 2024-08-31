<?php

session_start();
include_once "database.php";

$outgoingId = $_SESSION['uniqueId'];

$value = mysqli_real_escape_string($conn, $_POST['searchValue']);
// echo $value . "\n";

$valueQuery = "SELECT * FROM users WHERE firstName LIKE '%{$value}%' OR lastName LIKE '%{$value}%'";
$valueResult = mysqli_query($conn, $valueQuery);

$output = "";


if (mysqli_num_rows($valueResult) == 0) {
    $output .= "No Users Found Related To Your Search . . . . .";
} elseif (mysqli_num_rows($valueResult) > 0) {
    while ($row = mysqli_fetch_assoc($valueResult)) {
        if ($row['uniqueId'] != $_SESSION['uniqueId']) {

            $query1 = "SELECT * FROM messages WHERE (outgoingMsgId = {$outgoingId} AND incomingMsgId = {$row['uniqueId']}) 
                        OR (outgoingMsgId = {$row['uniqueId']}) AND (incomingMsgId = {$outgoingId})
                        ORDER BY msgId DESC LIMIT 1";

            $result1 = mysqli_query($conn, $query1);

            if (mysqli_num_rows($result1) > 0) {
                $row2 = mysqli_fetch_assoc($result1);
                if (strlen($row2['msg']) > 30) {
                    $msg = substr($row2['msg'], 0, 30) . '. . .';
                } else {
                    $msg = $row2['msg'];
                }
                if ($row2['outgoingMsgId'] == $outgoingId) {
                    $msg = 'You : ' . $msg;
                }
                //  else {
                //     $msg = '' . $msg;
                // }
            } else {
                $msg = "No messages Available";
            }

            // changing status of the friends
            if ($row['status'] == "Offline") {
                $offlineStatus = "offline";
            } else {
                $offlineStatus = "";
            }

            $output .= '<a href="./chat.php?receiverId=' . $row['uniqueId'] . '">
                        <div class="user-content">
                            <img src="PHP/User Images/' . $row['image'] . '" alt="profile image" class="user-profile-image" />
                            <div class="user-details">
                                <span class="user-name">' . $row['firstName'] . " " . $row['lastName'] . '</span>
                                <p class="last-msg">' . $msg . '</p>
                            </div>
                        </div>
                        <div class="status-dot ' . $offlineStatus . '"><i class="fa-solid fa-circle"></i></div>
                    </a>';
        }
    }
}


echo $output;


?>