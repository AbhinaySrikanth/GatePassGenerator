<?php include 'includes/header.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['admin'])) {
        header('Location: ../website/admin/admin.php');
    } else {
        header('Location: ../website/gatepass/gatepass.php');
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div class="ibody">
        <img class ="i1" src="images/4.jpg">
        <div class="inbody">
        
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h2></h2>

                <input class="b1" type="submit" name="admin" value="click here  for admin login">

                <input class="b1"type="submit" name="gatepass" value="Click here for gatepass login">

            </form>
        </div>
    </div>
</body>

</html>
<?php include 'includes/footer.php'; ?>