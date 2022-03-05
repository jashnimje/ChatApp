<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];

$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND unique_id NOT IN 
(SELECT friend_id FROM friends WHERE user_id = {$outgoing_id}) AND unique_id NOT IN
(SELECT user_id FROM friends WHERE friend_id = {$outgoing_id})
 ORDER BY user_id DESC;";

$query = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "data-all.php";
}
echo $output;