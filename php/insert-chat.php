<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";

    $iv = openssl_random_pseudo_bytes(16);

    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $sender = $outgoing_id;
    $receiver = $incoming_id;

    include("encrypt.php");

    $iv = bin2hex($iv);

    if (!empty($msg)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, iv) 
        VALUES ({$incoming_id}, {$outgoing_id}, '{$msg}', '{$iv}')") or die();
    }
} else {
    header("location: ../login.php");
}