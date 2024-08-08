<?php
session_start(); 
include "connectionLogin.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs (optional)

    $sql = "SELECT * FROM observers WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        if (($username == 'admin1@est' || $username == 'admin2@est') && $password == 'adminest') {
            // User is an admin, redirect to admin.php
            header("Location: admin.php");
            exit();
        }
        
        header("Location: entering species name.php"); // Correct file name
        exit();
    } else {
        header("Location: Login.php?error=Incorrect%20Username%20or%20Password");
        exit();
    }
} else {
    header("Location: Login.php");
    exit();
}
?>
