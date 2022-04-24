<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $prevDate = "";
        while ($row = mysqli_fetch_assoc($query)) {
            $iv = hex2bin($row['iv']);
            $msg = $row['msg'];

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
            $message = openssl_decrypt($msg, $cipher, $key, $options, $iv);

            $time = $row['time'];
            $currDate = date("d/m/y", strtotime($time));
            $time = date("h:i a", strtotime($time));

            if ($prevDate == "" || $prevDate != $currDate) {
                $temp = $currDate;
                if ($currDate == date('d/m/y')) {
                    $currDate = "Today";
                } else if ($currDate == date('d/m/y', strtotime("yesterday"))) {
                    $currDate = "Yesterday";
                } else {
                    $currDate = date("d/m/y", strtotime($time));
                }
                $output .= "<div class='chatDate'>{$currDate}</div>";
                $currDate = $temp;
            }

            // Change header class if message is incoming or outgoing
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">';
            } else {
                $output .= '<div class="chat incoming">
                                <div class="details">';
            }

            // Check if user has attachment or text
            if ($row['type'] != 'text') {
                // To Display in Other format for different type
                $ext = explode(".", $message)[1];
                $tmp = ucfirst($row['type']) . " - " . $ext;

                $output .= '<p class="chatbox"><a target="_blank" href="./assets/attachments/' . $message . '">' . $tmp  . '</a></p>';
            } else {
                $output .= '<p class="chatbox">' . $message . '</p>';
            }
            // Concatinate time (common element)
            $output .= '<p class="timestamp">' . $time . '</p>
                            </div>
                        </div>';
            $prevDate = $currDate;
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}