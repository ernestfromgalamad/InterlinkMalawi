<?php
// Include database connection
include 'db.php';

// Initialize variables for form fields
$username = $email = $password = "";
$username_err = $email_err = $password_err = $terms_err = "";

// Form submission processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username is required.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Password is required.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must be at least 6 characters long.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate terms
    if (!isset($_POST["terms"])) {
        $terms_err = "You must agree to the terms and conditions.";
    }

    // If no errors, proceed to insert into the database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($terms_err)) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert the user into the database
        try {
            $sql = "INSERT INTO artists (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);

            // Bind parameters to prevent SQL injection
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashed_password);

            // Execute the query
            if ($stmt->execute()) {
                // Set success message in session
                session_start();
                $_SESSION['success_message'] = "Account created successfully! You can now log in.";

                // Redirect to create_account_form.php to display success message
                header("Location: create_account_form.php");
                exit;
            } else {
                echo "An error occurred. Please try again.";
            }
        } catch (PDOException $e) {
            die("Error inserting data: " . $e->getMessage());
        }
    } else {
        // Store the errors to be displayed on the form
        session_start();
        $_SESSION['username_err'] = $username_err;
        $_SESSION['email_err'] = $email_err;
        $_SESSION['password_err'] = $password_err;
        $_SESSION['terms_err'] = $terms_err;

        // Redirect back to the form with errors
        header("Location: create_account_form.php");
        exit;
    }
}
?>
