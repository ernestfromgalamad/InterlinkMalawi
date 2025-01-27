<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_form.php");
    exit;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection
    include 'db.php';

    // Validate and sanitize form inputs
    $project_id = isset($_POST['project_id']) ? (int) $_POST['project_id'] : 0;
    $project_name = isset($_POST['project_name']) ? trim($_POST['project_name']) : '';
    $project_description = isset($_POST['project_description']) ? trim($_POST['project_description']) : '';
    $project_type = isset($_POST['project_type']) ? $_POST['project_type'] : '';
    $tags = isset($_POST['tags']) ? trim($_POST['tags']) : '';
    
    // Handle file upload for media (if any)
    $project_media = null;
    if (isset($_FILES['project_media']) && $_FILES['project_media']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/projects/';
        $file_name = basename($_FILES['project_media']['name']);
        $file_path = $upload_dir . $file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['project_media']['tmp_name'], $file_path)) {
            $project_media = $file_path;
        } else {
            echo "Failed to upload media.";
            exit;
        }
    } else {
        // If no new media is uploaded, retain the existing media
        if (isset($_POST['current_media']) && !empty($_POST['current_media'])) {
            $project_media = $_POST['current_media'];
        }
    }

    // Update project in the database
    try {
        $stmt = $pdo->prepare("UPDATE projects SET project_name = :project_name, project_description = :project_description, project_type = :project_type, tags = :tags, project_media = :project_media WHERE id = :project_id");
        
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':project_description', $project_description);
        $stmt->bindParam(':project_type', $project_type);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':project_media', $project_media);
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);

        $stmt->execute();

        // Redirect to the project details page after successful update
        header("Location: my_projects.php?id=" . $project_id);
        exit;
    } catch (PDOException $e) {
        die("Error updating project: " . $e->getMessage());
    }
} else {
    // Redirect if the form is not submitted correctly
    echo "Invalid request method.";
    exit;
}
?>
