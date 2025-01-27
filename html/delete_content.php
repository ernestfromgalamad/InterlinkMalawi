<?php
// Include the database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the content ID to be deleted
    $content_id = $_POST['content_id'];

    // Prepare the delete query
    $stmt = $pdo->prepare("DELETE FROM `content` WHERE `id` = :id");
    $stmt->bindParam(':id', $content_id, PDO::PARAM_INT);

    // Execute the delete query
    try {
        $stmt->execute();
        
        // Redirect to the content list page or show success message
        header("Location: posts_dashboard.php");
        exit;
    } catch (PDOException $e) {
        // If there is an error, you can handle it here
        echo "Error deleting content: " . $e->getMessage();
    }
}
?>
