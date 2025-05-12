<?php include '../includes/header.php'; ?>
<?php
include("../db/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $npassword = $_POST['npassword'];
    $rpassword = $_POST['rpassword'];
    $userid = rand(1111111, 9999999);
    
    if(empty($npassword)){
        echo '<span style="color: red; font-size: 20px;">Please enter new password.</span>';
    }else if ($npassword !== $rpassword) {
        echo '<span style="color: red; font-size: 20px;">Password does not match.</span>';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            echo '<span style="color: red; font-size: 20px;">Invalid email format.</span>';
        }else{
        $password = password_hash($npassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO admin (id,password,name,age,gender,email,mobileno,address,designation,department) 
                        VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isssssssss", $userid, $password, $name, $age, $gender, $email, $mobileno, $address, $designation, $department);
        try{
            $stmt->execute();
            echo '<span style="color: green; font-size: 20px;">you are registered successfully.<br></span>';
            echo '<span style="color: green; font-size: 20px;">"Your userid is: '.$userid.'".<br></span>';
        } catch(Exception $e){
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    }
}
?>
<!DOCTYPE html>
<html>

<head><link rel="stylesheet" href="../styles/styles.css"></head>

<body>
    <div class="reg">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <h2>Admin Register</h2>
        <label>Name:</label>
        <input type="text" name="name"><br>
        <label>Age:</label>
        <input type="number" name="age"><br>
        <label>Gender:</label>
        <input type="text" name="gender"><br>
        <label>Email:</label>
        <input type="email" name="email"><br>
        <label>Mobile NO:</label>
        <input type="number" name="mobileno"><br>
        <label>Address:</label>
        <input type="text" name="address"><br>
        <label>Designation:</label>
        <input type="text" name="designation"><br>
        <label>Department:</label>
        <input type="text" name="department"><br>
        <label>Enter new password:</label>
        <input type="password" name="npassword"><br>
        <label>Re-Enter new password:</label>
        <input type="password" name="rpassword"><br>
        <a class="link" href="../admin/admin.php">back to login</a><br>
        <input class="rg" type="submit" name="register" value="Register"><br>
    </form>
    </div>
</body>

</html>
<?php include '../includes/footer.php'; ?>