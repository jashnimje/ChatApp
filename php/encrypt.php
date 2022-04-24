<?php
// AES Algorithm
$sqlSettings = "SELECT * FROM settings WHERE id = 1";
$querySettings = mysqli_query($conn, $sqlSettings);
$key = "";
$cipher = "";
$options = 0;
if (mysqli_num_rows($querySettings) > 0) {
    while ($rowSettings = mysqli_fetch_assoc($querySettings)) {
        $key = $rowSettings['private_key'];
        $cipher = $rowSettings['cipher'];
    }
}
$msg = openssl_encrypt($msg, $cipher, $key, $options, $iv);

// RSA Algorithm
$sqlReceiver = "SELECT * FROM users WHERE unique_id = '{$receiver}'";
$queryReceiver = mysqli_query($conn, $sqlReceiver);

$receiver_public_key = "";
$receiver_private_key = "";

if (mysqli_num_rows($queryReceiver) > 0) {
    while ($rowReceiver = mysqli_fetch_assoc($queryReceiver)) {
        $receiver_public_key = $rowReceiver['public_key'];
        $receiver_private_key = $rowReceiver['private_key'];
    }
}
$encrypted = "";

if (openssl_public_encrypt($msg, $encrypted, $receiver_public_key)) {
    $msg = base64_encode($encrypted);
} else {
    throw new Exception('Encryption error');
}