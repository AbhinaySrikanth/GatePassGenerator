<?php include '../includes/header.php';?>
<?php
include("../db/database.php");
session_start();

// Assuming the user ID is stored in the session after login
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $current_password = $_POST['opassword'];
    $new_password = $_POST['npassword'];
    $confirm_password = $_POST['cpassword'];

    // Check if new passwords match
    if ($new_password !== $confirm_password) {
        echo '<span style="color: red; font-size: 20px;">New passwords does not match.</span>';
    } else {
        // Fetch the current password from the database
        $sql = "SELECT password FROM admin WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        // Verify the current password
        if (password_verify($current_password, $hashed_password)) {
            // Hash the new password
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $sql = "UPDATE admin SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $new_hashed_password, $username);

            if ($stmt->execute()) {
                echo '<span style="color: green; font-size: 20px;">Password changed successfully.</span>';
                echo "<meta http-equiv='refresh' content='10;url=dashboard.php'>";
            } else {
                echo '<span style="color: red; font-size: 20px;">Error updating password.</span>';
            }

            $stmt->close();
        } else {
            echo '<span style="color: red; font-size: 20px;">Current password is incorrect.</span>';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <div class="a1">
        <img class="i2" src="../images/5.jpg">
        <div class="p2">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h2 style="font-size: 40px;">change password</h2>
                <label style="font-size: 30px;"> Old password:</label>
                <input style="font-size: 20px;" type="passowrd" name="opassword"><br>
                <label style="font-size: 30px;"> new Password:</label>
                <input style="font-size: 20px;" type="password" name="npassword"><br>
                <label style="font-size: 30px;">Confirm new Password:</label>
                <input style="font-size: 20px;" type="password" name="cpassword"><br>
                <input class="al" type="submit" name="change" value="Change">

            </form>
        </div>
    </div>
</body>

</html>
<?php include '../includes/footer.php'; ?>