<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Species Description</title>
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
            background-image: url('https://img.freepik.com/free-vector/gradient-background-green-modern-designs_343694-2067.jpg');        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            max-width: 800px; /* Limiting maximum width of the container */
            margin: 20px; /* Adding margin for better spacing */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Shadow effect */
            min-height: 400px; /* Ensuring a minimum height for the container */
            overflow: auto; /* Adding overflow for scrolling if content exceeds container height */
        }

        h1 {
            color: #333;
        }

        .description {
            text-align: justify; /* Justify text for better readability */
            white-space: pre-wrap; /* Preserve whitespace and wrap long lines */
            overflow-wrap: break-word; /* Break long words to prevent overflow */
            line-height: 1.5; /* Set line height */
            padding: 10px; /* Add padding for better appearance */
            border: 1px solid #ccc; /* Add border for separation */
            border-radius: 5px; /* Add border radius for rounded corners */
            background-color: #fff; /* White background */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Species Description</h1>
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

    // Prepare SQL statement to retrieve description based on the species name
    $sql = "CALL GetSpeciesDetailsByName(?)";
        $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $speciesName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display species description if found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p><strong>Scientific Name:</strong> " . $row["ScientificName"] . "</p>";
        echo "<p><strong>Class:</strong> " . $row["Class"] . "</p>";
        echo "<p><strong>Order:</strong> " . $row["Orders"] . "</p>";
        echo "<p><strong>Family:</strong> " . $row["Family"] . "</p>";
        echo "<div class='description'><strong>Description:</strong><br>" . $row["Description"] . "</div>";
    } else {
        echo "<p>No description available for this species.</p>";
    }

    // Close database connection
    $conn->close();
    ?>
</div>

</body>
</html>
