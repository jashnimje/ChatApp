<?php
session_start();
include_once "config.php";

// Current User
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
$user_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
if (mysqli_num_rows($sql) <= 0) {
    echo "No User Found!";
    session_destroy();
    header("location: login.php");
}

// Friend User
if (!isset($_GET['user_id']) || $_GET['user_id'] == "") {
    header("location: users.php");
}
$friend_id = $_GET['user_id'];
$friend_id = mysqli_real_escape_string($conn, $friend_id);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = $friend_id");

if (mysqli_num_rows($sql) > 0) {
    $result = mysqli_fetch_assoc($sql);
    $unique_id = $result['unique_id'];
    $fname = $result['fname'];
    $lname = $result['lname'];
    $password = $result['password'];
    $email = $result['email'];
    $img = $result['img'];
    $status = $result['status'];
} else {
    echo "No Friend User Found!";
    header("location: users.php");
}

$user_id = mysqli_real_escape_string($conn, $user_id);
$sql = mysqli_query($conn, "INSERT INTO friends (user_id, friend_id) VALUES ($user_id, $friend_id);");
if ($sql) {
    header("location: ../dashboard.php");
} else {
    echo "Error: " . mysqli_error($conn);
    // header("location: users.php");
}