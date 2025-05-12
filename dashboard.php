<?php include '../includes/header.php'; ?>
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cpassword'])) {
        header("Location: cngpassword.php");
    } else if (isset($_POST['avisitor'])) {
        header("Location: addvisitor.php");
    } else {

        header("Location: logout.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <div class="ad1">
        <img class="i3" src="../images/6.jpg">
        <div class="ad2">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <h2 style="font-size: 40px;">Admin Dashboard</h2>
                <label style="font-size: 30px;">click here to change password:</label><br>
                <input class="dl" type="submit" name="cpassword" value="Change"><br>
                <label style="font-size: 30px;">click here to add a visitor:</label><br>
                <input class="dl" type="submit" name="avisitor" value="visitor"><br>
                <label style="font-size: 30px;">click here to logout:</label><br>
                <input class="dl" type="submit" name="logout" value="logout"><br>
    </form>
    </div>
    </div>

</body>

</html>
<?php include '../includes/footer.php'; ?>