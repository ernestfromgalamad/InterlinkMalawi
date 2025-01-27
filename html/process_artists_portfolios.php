<?php
// Start the session
session_start();

// Include database connection
include 'db.php';

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get portfolio details from the form
    $education = sanitize($_POST['education']);
    $expertise = sanitize($_POST['expertise']);
    $awards = sanitize($_POST['awards']);
    $skills = sanitize($_POST['skills']);
    $projects = sanitize($_POST['projects']);
    $portfolio_link = sanitize($_POST['portfolioLink']);

    // Update portfolio details in the database
    try {
        $sql = "UPDATE portfolio_details SET education = :education, expertise = :expertise, awards = :awards, 
                skills = :skills, projects = :projects, portfolio_link = :portfolio_link 
                WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':education', $education);
        $stmt->bindParam(':expertise', $expertise);
        $stmt->bindParam(':awards', $awards);
        $stmt->bindParam(':skills', $skills);
        $stmt->bindParam(':projects', $projects);
        $stmt->bindParam(':portfolio_link', $portfolio_link);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Set success message
        $_SESSION['message'] = ['success' => 'Portfolio details updated successfully.'];
    } catch (PDOException $e) {
        $_SESSION['message'] = ['error' => 'Error updating portfolio details: ' . $e->getMessage()];
    }

    // Redirect back to the portfolio page
    header('Location: portfolio_overview.php');
    exit();
}
?>
