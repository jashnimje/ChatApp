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
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="assets/images/profile/<?php echo $img; ?>" alt="">
                <div class="details">
                    <span><?php echo $fname . " " . $lname ?></span>
                    <p><?php echo $status; ?></p>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                    autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="javascript/chat.js"></script>

</body>

</html>