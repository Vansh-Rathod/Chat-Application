<?php

session_start();
if (!isset($_SESSION['uniqueId'])) {
  header("location: login.php");
} else {
  include_once "./PHP/database.php";
  $userQuery = "SELECT * FROM users WHERE uniqueId = {$_SESSION['uniqueId']}";
  $userResult = mysqli_query($conn, $userQuery);
  if (mysqli_num_rows($userResult) == 1) {
    $row = mysqli_fetch_assoc($userResult);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chat App | <?php echo $row['firstName'] . " " . $row['lastName'] ?></title>
  <link rel="stylesheet" href="user.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap"
    rel="stylesheet" />
</head>

<body>
  <div class="wrapper">
    <div class="users">
      <header>

        <!-- dont use this code , just for backup purpose-->
        <?php
        // include_once "./PHP/database.php";
        // $userQuery = "SELECT * FROM users WHERE uniqueId = {$_SESSION['uniqueId']}";
        // $userResult = mysqli_query($conn, $userQuery);
        // if (mysqli_num_rows($userResult) == 1) {
        //   $row = mysqli_fetch_assoc($userResult);
        // }
        ?>

        <div class="user-content">
          <img src="PHP/User Images/<?php echo $row['image'] ?>" alt="profile image" class="user-profile-image" />
          <div class="user-details">
            <span class="user-name"><?php echo $row['firstName'] . " " . $row['lastName'] ?></span>
            <p class="last-msg"><?php echo $row['status'] ?></p>
          </div>
        </div>
        <a href="PHP/logoutPHP.php?logoutId= <?php echo $row['uniqueId'] ?>" class="logout-btn">Logout</a>
      </header>
      <div class="horizontal-line"></div>
      <div class="search-section">
        <span class="text">Select a user to start chat</span>
        <input type="text" placeholder="Enter name to search . . .">
        <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
      <div class="users-list">
        <!-- data will come from usersPHP.php file -->

      </div>
    </div>
  </div>
  <script src="Javascript/users.js"></script>
  <script src="Javascript/showAlert.js"></script>
</body>

</html>