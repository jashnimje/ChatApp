<?php
session_start();
include_once "config.php";

$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) > 0) {
    $result = mysqli_fetch_assoc($sql);
    $img = $result['img'];
}

$unique_id = mysqli_real_escape_string($conn, $_POST['unique_id']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$status = mysqli_real_escape_string($conn, $_POST['status']);

// Check for empty fields
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {

    // Check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Check if image exists
        if ($_FILES['image']['size'] > 0) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if (in_array($img_ext, $extensions) === true) {
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if (in_array($img_type, $types) === true) {
                    $time = time();
                    $img = $time . $img_name;
                    if (!move_uploaded_file($tmp_name, "../assets/images/profile/" . $img)) {
                        echo "Error Uploading file";
                    }
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }
        }

        // Update the details
        $status = "Active now";
        $encrypt_pass = md5($password);

        $sql = "UPDATE users SET fname = '{$fname}', lname = '{$lname}', password = '{$encrypt_pass}', img = '{$img}', status = '{$status}' WHERE unique_id = '{$unique_id}';";
        $update_query = mysqli_query($conn, $sql);
        if ($update_query) {
            echo "Successfully Updated!";
        } else {
            echo "Something went wrong. Please try again!";
        }
    } else {
        echo "$email is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}