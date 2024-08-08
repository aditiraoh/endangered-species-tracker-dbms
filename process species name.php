<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "speciestracker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize the input
$speciesName = isset($_POST['speciesName']) ? trim($_POST['speciesName']) : '';

if (empty($speciesName)) {
    echo "Please enter a species name.";
} else {
    // Use prepared statement to avoid SQL injection
    $checkSpeciesQuery = $conn->prepare("SELECT * FROM species WHERE SpeciesName = ?");
    $checkSpeciesQuery->bind_param("s", $speciesName);
    $checkSpeciesQuery->execute();
    $checkSpeciesResult = $checkSpeciesQuery->get_result();

    if ($checkSpeciesResult !== false && $checkSpeciesResult->num_rows > 0) {
        // Species exists
        header("Location: three buttons.php?speciesName=" . urlencode($speciesName));
        exit();
    } else {
    //     Species not found in the database
    echo "Species not found in the database. Please enter a valid species name.";
    }

    $checkSpeciesQuery->close();
}

$conn->close();
?>
