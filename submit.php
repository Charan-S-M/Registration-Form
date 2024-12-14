<?php
// MySQL connection parameters
$servername = "localhost";
$username = "root"; // Default username in XAMPP
$password = "";     // Default password is blank in XAMPP
$dbname = "registration_db";

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $dob = htmlspecialchars($_POST['dob']);
    $gender = htmlspecialchars($_POST['gender']);
    $address = htmlspecialchars($_POST['address']);

    // Establish a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query
    $sql = "INSERT INTO registrations (name, email, phone, dob, gender, address) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $dob, $gender, $address);

    // Execute the query and check if successful
    if ($stmt->execute()) {
        $submissionSuccess = true;
    } else {
        $submissionError = $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Success</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="output-container">
        <?php if (isset($submissionSuccess) && $submissionSuccess): ?>
            <h2>Submission Successful!</h2>
            <p><strong>Full Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
            <p><strong>Address:</strong> <?php echo nl2br($address); ?></p>
        <?php else: ?>
            <h2>Submission Failed</h2>
            <p>Error: <?php echo isset($submissionError) ? $submissionError : 'Unknown error'; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
