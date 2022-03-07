<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
// Current User
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) <= 0) {
    echo "No User Found!";
    session_destroy();
    header("location: login.php");
}

// Friend User
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
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
    header("location: login.php");
}
?>
<?php include_once "header.php"; ?>



<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="dashboard.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="assets/images/profile/<?php echo $img; ?>" alt="">
                <div class="details">
                    <span><?php echo $fname . " " . $lname ?></span>
                    <p><?php echo $status; ?></p>
                </div>
            </header>
            <div class="chat-box">

            </div>

            <!-- Model Popup -->
            <div class="attachForm attach-popup" id="attachForm">
                <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="attach-container">
                        <div class="attach-header">
                            <span>Attachments</span>
                            <a class="closeBtn" onclick="closeAttach()"><i class="fas fa-solid fa-circle-xmark"></i></a>
                        </div>

                        <div class="msg-text"></div>
                        <div class="success-text"></div>
                        <div class="error-text"></div>

                        <div class="attach-content">
                            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>"
                                hidden>
                            <div class="attach-item">
                                <label for="file-document">
                                    <i class="fas fa-solid fa-file-import"></i>
                                    <!-- <span>Upload Document</span> -->
                                </label>
                                <input id="file-document" name="document" onchange="getFileData(this);"
                                    style="display: none" type="file" />
                            </div>
                            <div class="attach-item">
                                <label for="file-image">
                                    <i class="fas fa-solid fa-image"></i>
                                    <!-- <span>Attach Image</span> -->
                                </label>
                                <input id="file-image" name="image" onchange="getFileData(this);" style="display: none"
                                    accept="image/*" type="file" />
                            </div>
                            <div class="attach-item">
                                <label for="file-video">
                                    <i class="fas fa-video"></i>
                                    <!-- <span>Record Video</span> -->
                                </label>
                                <input id="file-video" name="video" onchange="getFileData(this);" style="display: none"
                                    accept="video/*" type="file" />
                            </div>
                        </div>
                        <div class="attach-footer">
                            <input class="submitAttach addBtn" type="submit" name="submit" value="Upload">
                        </div>
                    </div>
                </form>
            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                    autocomplete="off">
                <button type="button" class="attach active" onclick="openAttach()"><i
                        class="fa-solid fa-paperclip"></i></button>
                <button class="send"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="javascript/chat.js"></script>

</body>

</html>