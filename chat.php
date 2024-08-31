<?php

session_start();
if (!isset($_SESSION['uniqueId'])) {
  header("location: login.php");
} else {
  include_once "./PHP/database.php";
  $getReceiverId = mysqli_real_escape_string($conn, $_GET['receiverId']);
  $userQuery = "SELECT * FROM users WHERE uniqueId = '$getReceiverId'";
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
  <link rel="stylesheet" href="chat.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap"
    rel="stylesheet" />

  <!-- showing alert if user leaves the tab or closes the browser -->
  <!-- <script>
    window.addEventListener('beforeunload', function (e) {
    // Set a custom message
    const message = "Are you sure you want to leave? Changes you made may not be saved.";
    
    // Standard for most browsers
    e.preventDefault();
    
    // Chrome requires returnValue to be set
    e.returnValue = message;
    
    return message;

});
  </script> -->
</head>

<body>
  <div class="wrapper">
    <div class="chat-area">
      <header>

        <!-- dont use this code , just for backup purpose-->
        <?php
        // include_once "./PHP/database.php";
        // $getReceiverId = mysqli_real_escape_string($conn, $_GET['receiverId']);
        // $userQuery = "SELECT * FROM users WHERE uniqueId = '$getReceiverId'";
        // $userResult = mysqli_query($conn, $userQuery);
        // if (mysqli_num_rows($userResult) == 1) {
        //   $row = mysqli_fetch_assoc($userResult);
        // }
        ?>

        <a href="users.php" class="back-btn">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
        <img src="PHP/User Images/<?php echo $row['image'] ?>" alt="profile image" class="user-profile-image" />
        <div class="user-details">
          <span class="user-name"><?php echo $row['firstName'] . " " . $row['lastName'] ?></span>
          <p class="user-status"><?php echo $row['status'] ?></p>
        </div>
      </header>
      <div class="horizontal-line"></div>
      <div class="chat-box">
        <!-- <div class="chat outgoing">
          <div class="chat-details">
            <p class="message">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Distinctio, est.
            </p>
          </div>
        </div>
        <div class="chat incoming">
          <img src="./Images/alexander-hipp-iEEBWgY_6lA-unsplash.jpg" alt="user-friend-image"
            class="user-friend-image" />
          <div class="chat-details">
            <p class="message">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Distinctio, est.
            </p>
          </div>
        </div> -->

        <div class="security-info">
          <p><i class="fa-solid fa-lock"></i> Messages are end-to-end Encrypted.</p>
        </div>
      </div>
      <div class="horizontal-line"></div>
      <form action="#" class="typing-area" autocomplete="off">
        <input type="text" name="outgoing-id" value="<?php echo $_SESSION['uniqueId'] ?>" hidden>
        <input type="text" name="incoming-id" value="<?php echo $getReceiverId ?>" hidden>
        <input type="text" name="message" placeholder="Type a message here...." class="text-input">
        <button class="send-btn"><i class="fa-solid fa-paper-plane"></i></button>
      </form>
    </div>
  </div>
  <script src="Javascript/chat.js"></script>
  <script src="Javascript/showAlert.js"></script>
</body>

</html>