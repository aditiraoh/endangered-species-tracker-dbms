<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservation Status </title>
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
    background-image: url('https://img.freepik.com/free-vector/gradient-background-green-modern-designs_343694-2067.jpg');}
#legendBox {
            position: fixed; /* Fixed position */
            bottom: 10px; /* 10px from the bottom */
            right: 10px; /* 10px from the right */
            background-color: white; /* White background with transparency */
            padding: 10px;
            border: 1px solid #333; /* Darken border color */
            border-radius: 5px;
            font-size: 12px;
        }

.container {
    margin-top: 50px; /* Adjusted margin to center the container vertically */
    text-align: center;
    border: 2px solid black; /* Increased border width */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Enhanced shadow effect */
    padding: 30px; /* Increased padding */
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    max-width: 400px; /* Increased maximum width */
    width: 60%; /* Added width to center the container horizontally */
}


.details {
    margin-top: 20px;
}

.details h2 {
    color: #333; /* Darker text color */
    margin-bottom: 20px; /* Added margin to separate heading from details */
}

.details p {
    margin-bottom: 10px;
}

    </style>
</head>
<body>

<div class="container">
    <div class="details">
        <h2>    Conservation Status</h2>
        <?php
        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "speciestracker";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve species name from the URL parameter
        $speciesName = isset($_GET['speciesName']) ? $_GET['speciesName'] : '';

        // Use prepared statement to avoid SQL injection
        $query = $conn->prepare("CALL GetSpeciesStatusAndObservationDateByName(?)");
        $query->bind_param("s", $speciesName);
        $query->execute();
        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p><strong>Status Name:</strong> " . $row['statusName'] . "</p>";
                echo "<p><strong>Observation Date:</strong> " . $row['observationDate'] . "</p>";
                echo "<hr>";
            }
        } else {
            echo "<p>No conservation status details found.</p>";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
</div>
<div id="legendBox">
        <strong>Legend:</strong><br>
        LC: Least Concerned<br>
        NT: Not Threatened<br>
        VU: Vulnerable<br>
        EN: Endangered<br>
        CR: Critically Endangered<br>
        EX: Extinct
    
</div>

</body>
</html>
