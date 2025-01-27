<?php
// Include the database connection
include 'db.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_form.php");
    exit;
}

// Get the user ID from session (assuming 'user_id' is stored in session)
$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $education = !empty($_POST['education']) ? htmlspecialchars($_POST['education']) : '';
    $expertise = !empty($_POST['expertise']) ? htmlspecialchars($_POST['expertise']) : '';
    $awards = !empty($_POST['awards']) ? htmlspecialchars($_POST['awards']) : '';
    $skills = !empty($_POST['skills']) ? htmlspecialchars($_POST['skills']) : '';
    $projects = !empty($_POST['projects']) ? htmlspecialchars($_POST['projects']) : '';
    $portfolioLink = !empty($_POST['portfolioLink']) ? htmlspecialchars($_POST['portfolioLink']) : '';

    try {
        // Prepare the SQL query to update the portfolio details in the database for the logged-in user
        $stmt = $pdo->prepare("UPDATE artists SET 
            education = :education, 
            expertise = :expertise, 
            awards = :awards, 
            skills = :skills, 
            projects = :projects, 
            portfolio = :portfolio 
            WHERE id = :user_id");

        // Bind parameters to the query
        $stmt->bindParam(':education', $education);
        $stmt->bindParam(':expertise', $expertise);
        $stmt->bindParam(':awards', $awards);
        $stmt->bindParam(':skills', $skills);
        $stmt->bindParam(':projects', $projects);
        $stmt->bindParam(':portfolio', $portfolioLink);
        $stmt->bindParam(':user_id', $user_id);

        // Execute the query
        $stmt->execute();

        // Redirect to portfolio.php with a success message
        header("Location: portfolio.php?message=success");
        exit;

    } catch (PDOException $e) {
        // Error handling: Redirect to portfolio.php with an error message
        header("Location: portfolio.php?message=error");
        exit;
    }
}
?>
