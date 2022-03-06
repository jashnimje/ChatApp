<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    include_once "crypto.php";

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
            $message = str_openssl_dec($row['msg'], $iv);
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
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p class="chatbox">' . $message . '</p>
                                    <p class="timestamp">' . $time . '</p>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <div class="details">
                                    <p class="chatbox">' . $message . '</p>
                                    <p class="timestamp">' . $time . '</p>
                                </div>
                                
                                </div>';
            }
            $prevDate = $currDate;
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}