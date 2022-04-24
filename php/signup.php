<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$img = "";

// Check for empty fields
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {

    // Check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Check if User Exists
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exist!";
        } else {

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
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }

            $ran_id = rand(time(), 100000000);
            $status = "Online";
            $encrypt_pass = md5($password);

            // Generate public and private keys
            $res = openssl_pkey_new();
            $private_key = "";
            openssl_pkey_export($res, $private_key);
            $public_key = openssl_pkey_get_details($res)["key"];

            if ($img == "") {
                $img = "default.png";
            }
            $sql = "INSERT INTO users (unique_id, fname, lname, email, password, img, status, verify, public_key, private_key) 
                VALUES ('{$ran_id}', '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$img}', '{$status}', '0', '{$public_key}', '{$private_key}')";
            $insert_query = mysqli_query($conn, $sql);

            if ($insert_query) {
                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                if (mysqli_num_rows($select_sql2) > 0) {
                    $result = mysqli_fetch_assoc($select_sql2);
                    $_SESSION['unique_id'] = $result['unique_id'];
                    echo "success";
                } else {
                    echo "This email address not Exist!";
                }
            } else {
                echo "Something went wrong. Please try again!";
            }
        }
    } else {
        echo "$email is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}