<?php
session_start();
if(isset($_SESSION['uniqueId'])){
  header("location: users.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chat App | Login</title>
  <link rel="stylesheet" href="login.css" />

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
    <div class="login-section">
      <h1>Chat App</h1>
      <div class="horizontal-line"></div>
      <form action="#" autocomplete="off">
        <div class="error-txt">This is an error message</div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" placeholder="Enter your Email" name="email" required />
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" placeholder="Enter your Password" name="password" required />
          <!-- <i class="fa-solid fa-eye"></i> -->
          <i class="fa-solid fa-eye-slash" class="eye-btn"></i>
        </div>
        <div class="field login-btn">
          <input type="submit" value="Login" />
        </div>
      </form>
      <div class="link">
        Don't Have Account?
        <a href="index.php">Register here</a>
      </div>
    </div>
  </div>

  <script src="Javascript/eyeToggle.js"></script>
  <script src="Javascript/showAlert.js"></script>
  <script src="Javascript/login.js"></script>
</body>

</html>