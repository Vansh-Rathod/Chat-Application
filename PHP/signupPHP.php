<?php
session_start();
include_once "database.php";
$firstName = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastName = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {

    // validation of email address goes here!
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // if email is valid

        // checking email already exists or not?
        $emailQuery1 = "SELECT email FROM users WHERE email = '$email'";
        $emailResult1 = mysqli_query($conn, $emailQuery1);
        if (mysqli_num_rows($emailResult1) > 0) { // if email already exists

            echo "Email already exists!";

        } else { // if email does not exists

            // checking image file is uploaded or not
            if (isset($_FILES['image'])) { // if file is uploaded

                $imgName = $_FILES['image']['name']; // getting user uploaded image name
                // $imgType = $_FILES['image']['type']; // getting user uploaded image type
                $imgTempName = $_FILES['image']['tmp_name']; // this temporary name is used to save img file in our folder

                // exploding the image to get the extension of the image i.e. jpg, png, jpeg
                $explodedImgName = explode(".", $imgName);
                $imgExtension = end($explodedImgName); // here is the extension of the image

                // valid image extensions are below
                $validImageExtensions = ['png', 'jpg', 'jpeg'];

                if (in_array($imgExtension, $validImageExtensions) === true) { // if the extension of image is valid

                    // $time variable will be used to rename the image, so as to make image name unique
                    $time = time();
                    $newImageName = $time . $imgName;

                    if (move_uploaded_file($imgTempName, "User Images/" . $newImageName)) { // if image successfully moved to our folder
                        $status = "Active Now";
                        $uniqueId = rand(time(), 10000000);

                        $insertQuery1 = "INSERT INTO users (uniqueId, firstName, lastName, email, password, image, status) VALUES ('$uniqueId', '$firstName', '$lastName', '$email', '$password', '$newImageName', '$status')";
                        $insertResult1 = mysqli_query($conn, $insertQuery1);

                        if ($insertResult1) {
                            $emailQuery2 = "SELECT * FROM users WHERE email = '$email'";
                            $emailResult2 = mysqli_query($conn, $emailQuery2);
                            if (mysqli_num_rows($emailResult2) > 0) {
                                $row = mysqli_fetch_assoc($emailResult2);

                                // using this session we will use uniqueId in other php files
                                $_SESSION['uniqueId'] = $row['uniqueId'];
                                echo "Successfully Registered!";
                            }
                        } else {
                            echo "Some Error Occured! Please Try Again";
                        }

                    }
                    // else {
                    //     echo "Unable to move the image to the folder";
                    // }
                } else {
                    echo "Please select a Profile Image with a Valid Extension!";
                }

            } else {
                echo "Please select a Profile Image!";
            }
        }
    } else {
        echo "Invalid email format!";
    }
} else {
    echo "All Input Fields are Required!";
}
?>