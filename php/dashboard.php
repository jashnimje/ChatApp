<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];

$sql = "SELECT * FROM users WHERE unique_id IN 
(SELECT friend_id FROM friends WHERE user_id = {$outgoing_id} AND approve = 1) OR unique_id IN 
(SELECT user_id FROM friends WHERE friend_id = {$outgoing_id} AND approve = 1) ORDER BY user_id;";

$query = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "data.php";
}
echo $output;