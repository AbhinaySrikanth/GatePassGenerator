<?php include '../includes/header.php'; ?>
<?php
include("../db/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passnumber= rand(111111,999999);
    $letterno = $_POST['letterno'];
    $firmname = $_POST['firmname'];
    $vname =$_POST['vname'];
    $vdesignation = $_POST['vdesignation'];
    $oname =$_POST['oname'];
    $odesignation = $_POST['odesignation'];
    $osection = $_POST['osection'];
    $description =$_POST['description'];
    $fdate = $_POST['fdate'];
    $ftime =$_POST['ftime'];
    $tdate = $_POST['tdate'];
    $ttime = $_POST['ttime'];
    
    
    if(empty($letterno)){
        
        echo '<span style="color: red; font-size: 20px;">Please enter Letter no.</span>';
    }else if (empty($oname)) {
        
        echo '<span style="color: red; font-size: 20px;">please enter offcier name to visit.</span>';
    }else if (empty($firmname)) {
        
        echo '<span style="color: red; font-size: 20px;">please enter name of firm.</span>';
    }else if (empty($vname)) {
        
        echo '<span style="color: red; font-size: 20px;">please enter visitors name.</span>';
    }else if (empty($vdesignation)) {
        
        echo '<span style="color: red; font-size: 20px;">please enter visitor designation.</span>';
    }else if (empty($odesignation)) {
        
        echo '<span style="color: red; font-size: 20px;">please enter offcier designation.</span>';
    }else if (empty($osection)) {
        
        echo '<span style="color: red; font-size: 20px;">please enter offcier section .</span>';
    }else if (empty($description)) {
        
        echo '<span style="color: red; font-size: 20px;">please enter purpose of visit.</span>';
    }else if (empty($fdate) || empty($ftime) || empty($tdate) || empty($ttime)) {
        echo '<span style="color: red; font-size: 20px;">Please select date and time.</span>';
    } else {
        
        
        $stmt = $conn->prepare("INSERT INTO visitor (passnumber,letterno,firmname,visitorname,visitordesignation,officername,officerdesignation,officersection,description,fromdate,fromtime,todate,totime) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("issssssssssss",$passnumber,$letterno,$firmname,$vname,$vdesignation,$oname,$odesignation,$osection,$description,$fdate,$ftime,$tdate,$ttime );
        try{
            $stmt->execute();
            echo '<span style="color: green; font-size: 20px;">sent visitors details successfully.</span><br>';
        } catch(Exception $e){
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="../styles/styles.css"></head>
<body>
<div class="v1">
        <img class ="i4" src="../images/8.jpg">
        <div class="v2">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <h2 style="font-size: 40px;">Visitor Permission Entry From</h2>
        <label style="font-size: 30px;">Letter No:</label>
        <input type="text"  name="letterno" ><br>
        <label style="font-size: 30px;">Name of the Firm:</label>
        <input type="text" name="firmname"><br>
        <label style="font-size: 30px;">Visitors Name:</label>
        <input type="text" name="vname"><br>
        <label style="font-size: 30px;">Visitor Designation:</label>
        <input type="text" name="vdesignation"><br>
        <label style="font-size: 30px;">Officer Name to visit:</label>
        <input type="text" name="oname"><br>
        <label style="font-size: 30px;">Officer Designation:</label>
        <input type="text" name="odesignation"><br>
        <label style="font-size: 30px;">OfficerSection:</label>
        <input type="text" name="osection"><br></label>
        <label style="font-size: 30px;" for="textarea">Purpose of Visit:</label>
        <textarea id="textarea"name="description">enter here </textarea><br>
        <label style="font-size: 30px;"> Permission From:</label>
        <input type="date" name="fdate"><input type="time" name="ftime">To<input type="date" name="tdate"><input type="time" name="ttime"><br>
        <input class="vs" type="submit" name="submit" value="submit"><br>
    </form>
        </div>
</div>
</body>
</html>
<?php include '../includes/footer.php'; ?>