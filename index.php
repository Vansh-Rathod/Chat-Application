<?php
session_start();
if (isset($_SESSION['uniqueId'])) {
  header("location: users.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chat App | Signup</title>
  <link rel="stylesheet" href="style.css" />

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
    <div class="signup-section">
      <h1>Chat App</h1>
      <div class="horizontal-line"></div>
      <form action="#" enctype="multipart/form-data" autocomplete="off">
        <div class="error-txt"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" placeholder="First Name" name="firstname" required />
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" placeholder="Last Name" name="lastname" required />
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" placeholder="Enter your Email" name="email" required />
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" placeholder="Create your Password" name="password" required />
          <!-- <i class="fa-solid fa-eye" class="eye-btn"></i> -->
          <i class="fa-solid fa-eye-slash" class="eye-btn"></i>
        </div>
        <div class="field profile-image">
          <label>Select Profile Image (Only .jpg, .jpeg & .png)</label>
          <input type="file" name="image" required />
        </div>
        <div class="field register-btn">
          <input type="submit" value="Register" />
        </div>
      </form>
      <div class="link">
        Already Registered?
        <a href="login.php">Login</a>
      </div>
    </div>
  </div>

  <script src="Javascript/eyeToggle.js"></script>
  <script src="Javascript/showAlert.js"></script>
  <script src="Javascript/signup.js"></script>

</body>

</html>