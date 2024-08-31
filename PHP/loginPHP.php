<?php
session_start();
include_once "database.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {

    $query1 = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result1 = mysqli_query($conn, $query1);

    if (mysqli_num_rows($result1) == 1) {

        $row = mysqli_fetch_assoc($result1);

        if ($row['status'] == "Offline") {
            $status = "Active Now";
            $statusQuery = "UPDATE users SET status = '$status' WHERE uniqueId = {$row['uniqueId']}";
            $statusResult = mysqli_query($conn, $statusQuery);

            if ($statusResult) {
                $_SESSION['uniqueId'] = $row['uniqueId'];
                echo "Successfully LoggedIn!";
            } else {
                echo "Something went wrong. Please try again later.";
            }
        } else if($row['status'] == "Active Now") {
            echo "Can't Access Your Account! \n";
            echo "Your Account is Already in Use";
        }
        else{
            echo "Your Account is Deactivated! \n";
        }

    } else {

        echo "Invalid Email or Password";
    }

} else {

    echo "All Input Fields are Required!";
}
?>