<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Species Observations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            /*background-size: cover;*/
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
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* Light background with transparency */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Shadow effect */
            width: 400px; /* Increased container width */
            position: relative; /* Added position relative for absolute positioning */
        }

        .heading {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333; /* Darker text color */
        }

        #speciesInput {
            padding: 10px;
            font-size: 16px;
            width: calc(100% - 30px); /* Adjusted width to accommodate button padding */
            margin-bottom: 20px; /* Added margin below the text box */
            box-sizing: border-box; /* Ensures padding and border are included in width */
        }

        #observationsButton {
            padding: 15px; /* Increased button size */
            font-size: 18px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            position: fixed;
            top: 20px;
            right: 20px;
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        #observationsButton:hover {
            background-color: #388e3c; /* Darker shade on hover */
        }

        #submitBtn {
            padding: 15px; /* Increased button size */
            font-size: 18px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        #submitBtn:hover {
            background-color: #388e3c; /* Darker shade on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="heading">Enter species name:</div>
    <form action="process species name.php" method="POST">
        <input type="text" id="speciesInput" name="speciesName" placeholder="Enter species name" required>
        <button type="submit" id="submitBtn">Submit</button>
    </form>
    <div id="errorDiv" style="color: red; margin-top: 10px;"></div></div>

<script>
    function submitForm() {
        event.preventDefault(); 
        const speciesName = document.getElementById('speciesInput').value;
        if (!speciesName) {
            document.getElementById('errorDiv').innerText = 'Please enter a species name.';
        } else {
           
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'process species name.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const response = xhr.responseText;
                    if (response === 'exists') {
                        // Species exists, redirect to three_buttons.php
                        window.location.href = `three buttons.php?speciesName=${encodeURIComponent(speciesName)}`;
                    } else {
                        // Species not found in the database
                        document.getElementById('errorDiv').innerText = 'Species not found in the database. Please enter a valid species name.';
                    }
                }
            };

            // Send the form data
            xhr.send('speciesName=' + encodeURIComponent(speciesName));
        }
    }
</script>
<button id="observationsButton" onclick="showRecent()">Recent Observations</button>
<script>
function showRecent() {
        
    window.location.href = "recent_observations.php";
}
</script>
</body>
</html>
