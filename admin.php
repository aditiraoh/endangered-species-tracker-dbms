<?php
session_start();
include "connectionLogin.php";

// Define variables to hold success message and error message
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $speciesName = $_POST['speciesName'];
    $updatedConservationStatus = $_POST['updatedConservationStatus'];
    $recentObservationDate = $_POST['recentObservationDate'];

    // Retrieve SpeciesID based on SpeciesName
 try{
    $sqlGetSpeciesID = "SELECT SpeciesID FROM Species WHERE SpeciesName = ?";
    $stmt = mysqli_prepare($conn, $sqlGetSpeciesID);
    mysqli_stmt_bind_param($stmt, "s", $speciesName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $speciesID);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($speciesID) { // Check if SpeciesID exists
        // Update observation date in the observations table
        $sqlUpdateObservation = "UPDATE Observations
                                 SET ObservationDate = ?
                                 WHERE SpeciesID = (SELECT SpeciesID FROM Species WHERE SpeciesName = ?)";

        $stmt = mysqli_prepare($conn, $sqlUpdateObservation);
        mysqli_stmt_bind_param($stmt, "ss", $recentObservationDate, $speciesName);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);

            // Update conservation status in the conservationStatus table
            $sqlUpdateConservationStatus = "UPDATE ConservationStatus
                                            SET StatusName = ?
                                            WHERE SpeciesID = (SELECT SpeciesID FROM Species WHERE SpeciesName = ?)";

            $stmt = mysqli_prepare($conn, $sqlUpdateConservationStatus);
            mysqli_stmt_bind_param($stmt, "ss", $updatedConservationStatus, $speciesName);
            if (mysqli_stmt_execute($stmt)) {
                // Set success message
                $successMessage = "Species information successfully updated!";
            } else {
                // Set error message if conservation status update fails
                throw new Exception("Error updating conservation status: " . mysqli_error($conn));
            }
            mysqli_stmt_close($stmt);
        } else {
            // Set error message if observation date update fails
            throw new Exception("Error updating observation date: " . mysqli_error($conn));

        }
    } else {
        // SpeciesName does not exist
        throw new Exception("Error: Species does not exist.");
    }
} catch (Exception $e) {
    // Handle any exceptions gracefully
    $errorMessage = "" . $e->getMessage();
}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; 
            color: #333; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-size: cover;
            background-image: url('https://img.freepik.com/free-vector/gradient-background-green-modern-designs_343694-2067.jpg');
        }

        form {
            background-color: #f9fafa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type='submit']{
            background-color: #20321e;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container{
            width: 450px;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #20321e;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="login.php" class="back-button">Back</a>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="speciesName">Species Name:</label>
            <input type="text" id="speciesName" name="speciesName" placeholder="Enter species name" required>

            <label for="updatedConservationStatus">Updated Conservation Status:</label>
            <input type="text" id="updatedConservationStatus" name="updatedConservationStatus" placeholder="Enter changed status" required>

            <label for="recentObservationDate">Recent Observation Date:</label>
            <input type="date" id="recentObservationDate" name="recentObservationDate" placeholder="Enter recent observed date" required>

            <input type="submit" value='Update'>
        </form>

        <?php
        // Display success message if it exists
        if (!empty($successMessage)) {
            echo "<p style='color: green;'>$successMessage</p>";
        }

        // Display error message if it exists
        if (!empty($errorMessage)) {
            echo "<p style='color: red;'>$errorMessage</p>";
        }
        ?>
    </div>
</body>
</html>