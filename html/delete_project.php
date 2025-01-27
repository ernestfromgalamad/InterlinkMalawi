<?php
// Include the database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the project ID to be deleted
    $project_id = $_POST['project_id'];

    // Prepare the delete query
    $stmt = $pdo->prepare("DELETE FROM `projects` WHERE `id` = :id");
    $stmt->bindParam(':id', $project_id, PDO::PARAM_INT);

    // Execute the delete query
    try {
        $stmt->execute();
        
        // Redirect to the project list page or show success message
        header("Location: my_projects.php");
        exit;
    } catch (PDOException $e) {
        // If there is an error, you can handle it here
        echo "Error deleting project: " . $e->getMessage();
    }
}
?>
