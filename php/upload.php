<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
} else {
    session_destroy();
    header("location: ../login.php");
}

if (isset($_POST["incoming_id"])) {

    // Check file type
    if ($_FILES['document']['name'] != "") {
        $file = $_FILES['document'];
        $extensions = array("pdf", "doc", "docx", "txt");
    } elseif ($_FILES['image']['name'] != "") {
        $file = $_FILES['image'];
        $extensions = array("jpeg", "jpg", "png", "gif");
    } elseif ($_FILES['video']['name'] != "") {
        $file = $_FILES['video'];
        $extensions = array("mp4", "avi", "mkv");
    }
    // elseif ($_FILES['audio']['name'] != "") {
    //     $file = $_FILES['audio'];
    //     $extensions = array("mp3", "wav", "flac");
    // } 
    else {
        echo "No file selected!";
        die();
    }

    // Error Codes
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    $filename = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fname = '';

    $tmp = explode('.', $filename);
    $file_ext = strtolower(end($tmp));
    $name = $tmp[0];

    $target_dir = "../assets/attachments/";

    $type = explode('/', $fileType);
    $type = $type[0];

    if (in_array($file_ext, $extensions)) {
        if ($fileError === 0) {
            if ($fileSize <= 1000000) {
                $fname = str_replace(' ', '', trim(ucwords($filename)));
                $target_file = $target_dir . $fname;

                // Check if file already exists
                if (file_exists($target_file)) {
                    $fname = str_replace(' ', '', trim($name)) . uniqid() . "." . $file_ext;
                    $target_file = $target_dir . $fname;
                }

                // Move file to target directory
                if (move_uploaded_file($fileTmpName, $target_file)) {
                    // Encrypt file name and path
                    $iv = openssl_random_pseudo_bytes(16);
                    $msg = $fname;

                    // Encrypts message
                    $sql3 = "SELECT * FROM settings WHERE id = 1";
                    $query3 = mysqli_query($conn, $sql3);
                    $key = "";
                    $cipher = "";
                    $options = 0;
                    if (
                        mysqli_num_rows($query3) > 0
                    ) {
                        while ($row3 = mysqli_fetch_assoc($query3)) {
                            $key = $row3['private_key'];
                            $cipher = $row3['cipher'];
                        }
                    }
                    $message = openssl_encrypt($msg, $cipher, $key, $options, $iv);
                    $iv = bin2hex($iv);

                    // Upload to database
                    $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, iv, type) 
                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$iv}', '{$type}');";
                    $sql = mysqli_query($conn, $sql);
                    if ($sql) {
                        echo "success";
                    } else {
                        echo "Something went wrong!";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, your file is too large.";
            }
        } else {
            echo $phpFileUploadErrors[$fileError];
            die();
        }
    } else {
        echo "Extension not allowed.";
    }
} else {
    echo "No file selected!";
}