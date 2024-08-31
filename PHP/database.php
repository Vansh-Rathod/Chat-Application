<?php

$SERVERNAME = "127.0.0.1:3307";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "chat";

$conn = mysqli_connect($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

if (!$conn) {
    die("Connection Failed! There's an Error" . mysqli_connect_error());
}
// else {
//     echo "Connected to Database";
// }

?>