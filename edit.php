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
        <section class="form edit">
            <header>
                <div class="content">
                    <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="assets/images/profile/<?php echo $img; ?>" alt="">
                    <div class="details">
                        <span>Edit Details </span>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $unique_id; ?>" class="logout">Logout</a>
            </header>
            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>

                <!-- Hidden Elements -->
                <input type="text" name="unique_id" value="<?php echo $unique_id; ?>" hidden required>
                <input type="text" name="status" value="<?php echo $status; ?>" hidden required>

                <!-- Visible Elements -->
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" value="<?php echo $fname; ?>" placeholder="First name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" value="<?php echo $lname ?>" placeholder="Last name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $email ?>" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Edit">
                </div>
            </form>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/edit.js"></script>

</body>

</html>