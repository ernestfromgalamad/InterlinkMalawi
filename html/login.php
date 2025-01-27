<?php
session_start(); // Start the session

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'db.php'; // Include your db.php file for PDO connection

// Initialize variables
$emailOrUsername = $password = "";
$emailOrUsernameErr = $passwordErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Email or Username
    if (empty(trim($_POST["email-username"]))) {
        $emailOrUsernameErr = "Please enter your email or username.";
    } else {
        $emailOrUsername = trim($_POST["email-username"]);
    }

    // Validate Password
    if (empty(trim($_POST["password"]))) {
        $passwordErr = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If there are no errors, check the user's credentials in the database
    if (empty($emailOrUsernameErr) && empty($passwordErr)) {
        try {
            // Prepare the SQL query to check if the username/email exists
            $sql = "SELECT id, username, password FROM artists WHERE username = :emailOrUsername OR email = :emailOrUsername";

            // Prepare the statement
            $stmt = $pdo->prepare($sql);

            // Bind the parameter
            $stmt->bindParam(':emailOrUsername', $emailOrUsername, PDO::PARAM_STR);

            // Execute the query
            $stmt->execute();

            // Check if any record exists
            if ($stmt->rowCount() == 1) {
                // Fetch the result
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Extract data
                $id = $row['id'];
                $username = $row['username'];
                $hashed_password = $row['password'];

                // Verify password
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;

                    // Redirect to the dashboard or a specific page
                    header("location: index.php");
                    exit();
                } else {
                    // Display error message for invalid password
                    $passwordErr = "The password you entered was incorrect.";
                }
            } else {
                // Display error message if no user found
                $emailOrUsernameErr = "No account found with that username/email.";
            }
        } catch (PDOException $e) {
            // Display error message if something goes wrong with the DB
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
