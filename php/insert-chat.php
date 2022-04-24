<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";

    $iv = openssl_random_pseudo_bytes(16);

    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    // Encrypts message
    $sql3 = "SELECT * FROM settings WHERE id = 1";
    $query3 = mysqli_query($conn, $sql3);
    $key = "";
    $cipher = "";
    $options = 0;
    if (mysqli_num_rows($query3) > 0) {
        while ($row3 = mysqli_fetch_assoc($query3)) {
            $key = $row3['private_key'];
            $cipher = $row3['cipher'];
        }
    }
    $message = openssl_encrypt($msg, $cipher, $key, $options, $iv);
    $iv = bin2hex($iv);

    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, iv) 
        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$iv}')") or die();
    }
} else {
    header("location: ../login.php");
}