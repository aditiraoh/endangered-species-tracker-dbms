<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
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
            background-size: cover;
            height: 100vh;
            background-image: url('https://img.freepik.com/free-vector/gradient-background-green-modern-designs_343694-2067.jpg');
        }

        form {
            background-color: #fff;
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

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <form id="signupForm" method="POST">
    <h2>SignUp</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Sign Up</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection details
        $host = "localhost";
        $username = "root"; // Replace with your database username
        $password = ""; // Replace with your database password
        $database = "speciestracker";

        // Create a database connection
        $connection = mysqli_connect($host, $username, $password, $database);

        // Check if the connection was successful
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the last observerID from the database
        $query = "SELECT observerID FROM observers ORDER BY CAST(SUBSTRING(observerID, 2) AS UNSIGNED) DESC LIMIT 1";
        $result = mysqli_query($connection, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $lastObserverID = $row['observerID'];
            // Extract the numeric part of the last observerID and increment it by one
            $numericPart = intval(substr($lastObserverID, 1));
            $newObserverID = 'u' . ($numericPart + 1);
        } else {
            // No existing entries, start with u1
            $newObserverID = 'u1';
        }

        // Get user input
        $enteredUsername = $_POST['username'];
        $enteredPassword = $_POST['password'];

        // Prepare and execute SQL statement to insert data into the observers table
        $query = "INSERT INTO observers (observerID, username, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sss", $newObserverID, $enteredUsername, $enteredPassword);
        $success = mysqli_stmt_execute($stmt);

        // Check if the insertion was successful
        if ($success) {
            echo "<p>Sign up successful!</p>";
            echo "<script>window.location.href = 'Login.php';</script>";
            exit();
        } else {
            echo "<p>Error: " . mysqli_error($connection) . "</p>";
        }

        // Close the statement and the connection
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
    }
    ?>

</body>
</html>