<?php include '../includes/header.php'; ?>
<?php
    include("../db/database.php");
    session_start();

    function verifyPassword($username, $password, $conn) {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT password FROM admin WHERE id = ?");
        $stmt->bind_param("i", $username);
        $stmt->execute();
        $stmt->store_result();
    
        // Check if the user exists
        if ($stmt->num_rows == 1) {
            // Bind result
            $password_hash="";
            $stmt->bind_result($password_hash);
            $stmt->fetch();
    
            // Verify password
            if (password_verify($password, $password_hash)) {
                return true;
            } else {
                return false;
            }
        } else {
            // User not found
            return false;
        }
    }

    if($_SERVER["REQUEST_METHOD"]== "POST"){
        if(isset($_POST['login'])){
            $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
            
            if(empty($username)){
                echo '<span style="color: red; font-size: 20px;">Username is empty.</span>';
            }else if(empty($password)){
                echo '<span style="color: red; font-size: 20px;">Password is empty.</span>';
            }else{
                if (verifyPassword($username, $password, $conn)) {
                    
                    header('Location: dashboard.php');
                    
                    $_SESSION['username']=$username;
                    $_SESSION['password']=$password;
                } else {
                    echo '<span style="color: red; font-size: 20px;">Invalid username or password.</span>';
                }
            }
        }else if(isset($_POST['register'])){
            header('Location: register.php');
        }

    }
?>

<!DOCTYPE html>
<html>
    <head><link rel="stylesheet" href="../styles/styles.css"></head>
    <body>
        <div class="a1">
        <img class ="i2" src="../images/5.jpg">
        <div class="a2">
        <form action="<?php htmlspecialchars($_SERVER[ 'PHP_SELF' ]) ?>" method="post">
            <h2 style="font-size: 40px;">Admin Login</h2>
            <label style="font-size: 30px;">Username:</label>
            <input style="font-size: 20px;" type="text" name="username"><br>
            <label style="font-size: 30px;">Password:</label>
            <input style="font-size: 20px;" type="password" name="password"><br>
            <input class ="al" type="submit" name="login" value="Login">
            <input class ="ar" type="submit" name="register" value="register">
            
        </form>
        </div>
        </div>
    </body>
</html>
<?php include '../includes/footer.php'; ?>