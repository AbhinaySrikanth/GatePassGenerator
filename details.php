<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Visitor Details</title>
    <style>
        body {
            background-color: #ccc;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        .details {
            max-width: 1200px;
            width: 100%;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .details h2 {
            text-align: center;
        }

        .details div {
            margin-bottom: 15px;
        }

        label {
            text-align: left;
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-row .form-field {
            flex: 1;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #captureBox {
            width: 100px;
            height: 130px;
            border: 1px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            background-color: #f8f8f8;
        }

        #capturedImage {
            display: none;
            max-width: 100%;
            max-height: 100%;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="details">
        <?php
        session_start();
        include('../db/database.php'); // Include the database connection file
        date_default_timezone_set('Asia/Kolkata'); // Set to your desired timezone

        if (isset($_GET['passnumber'])) {
            $passnumber = intval($_GET['passnumber']);
            $sql = "SELECT * FROM visitor WHERE passnumber = '$passnumber'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <h2>Visitor Pass Entry Form</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-field">
                            <label for="captureBox">Photo:</label>
                            <div id="captureBox">
                                <img id="capturedImage" src="" alt="Captured Image">
                            </div>
                        </div>
                        <div class="form-field">
                            <button type="button" id="resetButton" class="hidden">Reset Image</button>
                        </div>
                    </div>
                    <video id="video" class="hidden" width="320" height="240" autoplay></video>
                    <canvas id="canvas" class="hidden" width="320" height="240"></canvas>
                    <div>
                        <label for="passnumber">Pass No:</label>
                        <input type="text" id="passnumber" name="passnumber" value="<?php echo htmlspecialchars($row["passnumber"]); ?>" readonly>
                    </div>
                    <div>
                        <label for="options">Pass Type :</label>
                        <select id="options" name="options">
                            <option value="admin">ADMIN</option>
                            <option value="security">Security</option>
                        </select>
                    </div>
                    <div>
                        <label for="oname">Officer Name to Visit:</label>
                        <input type="text" id="oname" name="oname" value="<?php echo htmlspecialchars($row["officername"]); ?>" readonly>
                    </div>
                    <div>
                        <label for="odesignation">Officer Designation:</label>
                        <input type="text" id="odesignation" name="odesignation" value="<?php echo htmlspecialchars($row["officerdesignation"]); ?>" readonly>
                    </div>
                    <div>
                        <label for="osection">Officer section:</label>
                        <input type="text" id="osection" name="osection" value="<?php echo htmlspecialchars($row["officersection"]); ?>" readonly>
                    </div>
                    <div>
                        <label for="letterno">Authority Letter No:</label>
                        <input type="text" id="letterno" name="letterno" value="<?php echo htmlspecialchars($row["letterno"]); ?>" readonly>
                    </div>
                    <div>
                        <label for="vname">Visitor Name:</label>
                        <input type="text" id="vname" name="vname" value="<?php echo htmlspecialchars($row["visitorname"]); ?>" readonly>
                    </div>
                    <div>
                        <label for="vdesignation">Visitor Designation:</label>
                        <input type="text" id="vdesignation" name="vdesignation" value="<?php echo htmlspecialchars($row["visitordesignation"]); ?>" readonly>
                    </div>
                    <div>
                        <label for="sex">Sex:</label>
                        <select id="sex" name="sex">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="mobileno">Visitor Mobile No:</label>
                        <input type="text" id="mobileno" name="mobileno">
                    </div>
                    <div>
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location">
                    </div>
                    <div>
                        <label for="edt">Entry Date&Time:</label>
                        <input type="text" id="edt" name="edt" value="<?php echo htmlspecialchars(date('Y-m-d H:i:s')); ?>" readonly>
                    </div>
                    <div>
                        <label for="exdt">Exit Date&time</label>
                        <input type="text" id="exdt" name="exdt" value="<?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime('+1 day'))); ?>">
                    </div>

                    <input type="hidden" id="imageData" name="imageData">
                    <button type="submit" class="al" name="save" value="save">Save</button>
                    <button type="button" class="al" onclick="window.print()">Print</button>
                </form>
                
        <?php
            } else {
                echo '<span style="color: red; font-size: 20px;"><p>No details found for this visitor.</p></span>';
            }
        } else {
            echo '<span style="color: red; font-size: 20px;"><p>Invalid visitor ID.</p></span>';
        }

        $conn->close();
        ?>
    </div>
    <script>
        const captureBox = document.getElementById('captureBox');
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const capturedImage = document.getElementById('capturedImage');
        const imageDataInput = document.getElementById('imageData');
        const resetButton = document.getElementById('resetButton');

        // Access the webcam
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error("Error accessing webcam: ", err);
            });

        captureBox.addEventListener('click', () => {
            video.classList.remove('hidden');
            canvas.classList.remove('hidden');
        });

        video.addEventListener('click', () => {
            // Draw the current video frame to the canvas
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert the canvas image to data URL
            const imageDataUrl = canvas.toDataURL('image/png');

            // Display the captured image
            capturedImage.src = imageDataUrl;
            capturedImage.style.display = 'block';

            // Store the image data in a hidden input
            imageDataInput.value = imageDataUrl;

            // Hide the video and canvas
            video.classList.add('hidden');
            canvas.classList.add('hidden');
            resetButton.classList.remove('hidden');
        });

        resetButton.addEventListener('click', () => {
            capturedImage.src = '';
            capturedImage.style.display = 'none';
            imageDataInput.value = '';

            resetButton.classList.add('hidden');
        });
    </script>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../db/database.php'); // Include the database connection file again

    $passnumber = $_POST['passnumber'];
    $passtype = $_POST['options'];
    $oname = $_POST['oname'];
    $odesignation = $_POST['odesignation'];
    $osection = $_POST['osection'];
    $letterno = $_POST['letterno'];
    $vname = $_POST['vname'];
    $vdesignation = $_POST['vdesignation'];
    $sex = $_POST['sex'];
    $vnumber = $_POST['mobileno'];
    $location = $_POST['location'];
    $edt = $_POST['edt'];
    $exdt = $_POST['exdt'];
    $imageData = $_POST['imageData'];

    // Save image data to a file
    if ($imageData) {
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedImageData = base64_decode($imageData);
        $imageFileName = '../uploads/' . uniqid() . '.png';

        if (file_put_contents($imageFileName, $decodedImageData)) {
            echo "Image successfully saved: " . htmlspecialchars(basename($imageFileName));
        } else {
            echo "Error saving image.";
        }
    }

    if (isset($_POST['save'])) {
        $stmt = $conn->prepare("INSERT INTO visited (passnumber, officername, officerdesignation, officersection, letterno, visitorname, visitordesignation, sex, visitormobileno, location, entrydatetime, exitdatetime, imagepath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssssssss", $passnumber, $oname, $odesignation, $osection, $letterno, $vname, $vdesignation, $sex, $vnumber, $location, $edt, $exdt, $imageFileName);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Record successfully saved.";
        } else {
            echo "Error saving record.";
        }

        // Close the statement
        $stmt->close();
    }

    $conn->close();
}
?>
<?php include '../includes/footer.php'; ?>