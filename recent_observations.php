<!-- recent_observations.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Observations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            min-height: 100vh;
            background-image: url('https://img.freepik.com/free-vector/gradient-background-green-modern-designs_343694-2067.jpg');

        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 80%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #333; /* Darker border color */
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        h2 {
            color: #333;
            margin-top: 10px;
        }

        .logoutBtn {
            margin-top: 20px;
            padding: 10px;
            font-size: 16px;
            background-color: #ff3333;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logoutBtn:hover {
            background-color: #cc0000;
        }
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
    </style>
</head>
<body>

<div class="container">
    <h2>Recent Observations</h2>
    
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

    // Use prepared statement to avoid SQL injection
    $recentObservationsQuery = $conn->prepare("
    SELECT s.SpeciesName, s.ScientificName, l.LocationName, o.ObservationDate, cs.StatusName
    FROM species s
    JOIN location l ON s.SpeciesID = l.SpeciesID
    JOIN observations o ON s.SpeciesID = o.SpeciesID
    JOIN conservationstatus cs ON s.ConservationStatusID = cs.ConservationStatusID
    ORDER BY o.ObservationDate DESC
");
    $recentObservationsQuery->execute();
    $recentObservationsResult = $recentObservationsQuery->get_result();

    if ($recentObservationsResult !== false && $recentObservationsResult->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Species Name</th><th>Scientific Name</th><th>Location Name</th><th>Date of Observation</th><th>Status</th></tr>";
        while ($row = $recentObservationsResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['SpeciesName'] . "</td>";
            echo "<td>" . $row['ScientificName'] . "</td>";
            echo "<td>" . $row['LocationName'] . "</td>";
            echo "<td>" . (isset($row['ObservationDate']) ? $row['ObservationDate'] : '') . "</td>";
            echo "<td>" . $row['StatusName'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No recent observations found.";
    }

    $recentObservationsQuery->close();
    $conn->close();
    ?>

    <!-- Logout Button -->
    <button class="logoutBtn" onclick="logout()">Logout</button>
    
    <script>
        function logout() {
            // Redirect to HomePage
            window.location.href = 'HomePage.php';
        }
    </script>
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
