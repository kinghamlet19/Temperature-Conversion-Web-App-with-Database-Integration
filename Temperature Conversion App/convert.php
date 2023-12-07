<?php
// Database connection (update these credentials)
$host = 'localhost';
$dbname = 'temperature_db';
$user = 'faisal';
$pass = 'project123';

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$temperature = $_POST['temperature'];
$unit = $_POST['unit'];
$result = 0;

if ($unit == 'CtoF') {
    $result = $temperature * 9/5 + 32;
} else {
    $result = ($temperature - 32) * 5/9;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO conversions (original_value, converted_value, unit) VALUES (?, ?, ?)");
$stmt->bind_param("dds", $temperature, $result, $unit);
$stmt->execute();

echo "Converted Temperature: " . $result;

$stmt->close();
$conn->close();
?>
