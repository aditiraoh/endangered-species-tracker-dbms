<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Species Information</title>
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
            background-color: #D3D3D3; /* Light gray */
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #000; /* Black border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            height: 500;
            color: black;
        }

        .button {
            padding: 15px;
            font-size: 18px;
            background-color: rgb(0,100,0);
            color: white;
            border: none;
            cursor: pointer;
            margin: 10px;
            border-color: black;
            border: 2px solid black;
            width: 50%;
            box-sizing: border-box;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
    </style>
</head>
<body>

<div class="container">
    <div class="heading">Please choose an option:</div>
    <button class="button" onclick="showLocation()">Location</button>
    <button class="button" onclick="showConservationStatus()">Conservation Status</button>
    <button class="button" onclick="showDescription()">Description</button>
</div>

<script>
    function showLocation() {
        // Redirect to location.php with the speciesName parameter
        const speciesName = '<?= isset($_GET['speciesName']) ? $_GET['speciesName'] : '' ?>';
        if (speciesName) {
            window.location.href = `location.php?speciesName=${speciesName}`;
        } else {
            alert('Please enter a species name first.');
        }
    }

    function showConservationStatus() {
        // Redirect to the conservation status page
        const speciesName = '<?= isset($_GET['speciesName']) ? $_GET['speciesName'] : '' ?>';
        if (speciesName) {
            window.location.href = `conservation_status.php?speciesName=${speciesName}`;
        } else {
            alert('Please enter a species name first.');
        }
    }

    function showDescription() {
        // Redirect to the description page
        const speciesName = '<?= isset($_GET['speciesName']) ? $_GET['speciesName'] : '' ?>';
        if (speciesName) {
            window.location.href = `description.php?speciesName=${speciesName}`;
        } else {
            alert('Please enter a species name first.');
        }
    }
</script>

</body>
</html>
