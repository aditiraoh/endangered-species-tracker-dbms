<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Species Location</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover;
            background-image: url('https://img.freepik.com/free-vector/gradient-background-green-modern-designs_343694-2067.jpg');
        }

        .container {
    text-align: center;
    background-color: #f0f0f0; /* Light gray */
    padding: 20px;
    border-radius: 10px;
    border: 2px solid #000; /* Black border */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 400px;
}

h1 {
    color: #333;
    margin-bottom: 20px;
}

.location-info {
    margin-bottom: 10px;
}

.location-label {
    font-weight: bold;
    color: #007bff; /* Bold blue */
}

.location-data {
    color: #333;
}

.footer {
    margin-top: 20px;
    font-size: 14px;
    color: #555;
}




    </style>
</head>
<body>

<div class="container">
    <h1>Species Location</h1>
    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "speciestracker";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the species name from the query parameter
    $speciesName = $_GET['speciesName'];

    // Prepare SQL statement to retrieve location information based on the species name
    $sql = "CALL GetLocationBySpeciesName(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $speciesName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display location information if found
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Location: " . $row["locationName"] . "</p>";
            echo "<p>Latitude: " . $row["latitude"] . "</p>";
            echo "<p>Longitude: " . $row["longitude"] . "</p>";
        }
    } else {
        echo "<p>No location information available for this species.</p>";
    }

    // Close database connection
    $conn->close();
    ?>
</div>

</body>
</html>
