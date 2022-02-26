<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
// Current User
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
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
    echo "No User Found!";
    session_destroy();
    header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="assets/images/profile/<?php echo $img; ?>" alt="">
                    <div class="details">
                        <span><?php echo $fname . " " . $lname; ?>
                            <a href="edit.php?id=<?php echo $unique_id; ?>"><i class="fas fa-edit"></i></a></span>
                        <p><?php echo $status; ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $unique_id; ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>

    <script src="javascript/users.js"></script>

</body>

</html>