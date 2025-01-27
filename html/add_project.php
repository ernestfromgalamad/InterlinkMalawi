<?php 
// Include the database connection
include 'db.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit;
}

// Get the logged-in user ID from the session
$user_id = $_SESSION['user_id'];  // Assuming `user_id` corresponds to `id` in the artists table

// Retrieve the fullname from the artists table (concatenate first_name and last_name)
try {
    $stmt = $pdo->prepare("SELECT first_name, last_name FROM artists WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $artist = $stmt->fetch(PDO::FETCH_ASSOC);
    $fullname = $artist['first_name'] . ' ' . $artist['last_name'];  // Concatenate manually
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get POST values
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $project_type = $_POST['project_type'];
    $tags = isset($_POST['tags']) ? $_POST['tags'] : '';  // Default to empty string if not set
    $project_media = null;

    // Handle file upload
    if (isset($_FILES['project_media']) && $_FILES['project_media']['error'] == 0) {
        $media_name = $_FILES['project_media']['name'];
        $media_tmp_name = $_FILES['project_media']['tmp_name'];
        $media_path = 'uploads/' . basename($media_name);

        // Move the uploaded file to the desired location
        if (move_uploaded_file($media_tmp_name, $media_path)) {
            $project_media = $media_path;
        } else {
            die("Error uploading the file.");
        }
    }

    // Insert the project into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO projects (user_id, fullname, project_name, project_description, project_type, project_media, tags) 
                               VALUES (:user_id, :fullname, :project_name, :project_description, :project_type, :project_media, :tags)");

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':project_description', $project_description);
        $stmt->bindParam(':project_type', $project_type);
        $stmt->bindParam(':project_media', $project_media);
        $stmt->bindParam(':tags', $tags);

        // Execute the query
        $stmt->execute();

        // Redirect to projects.php after successful insertion
        header("Location: my_projects.php?message=success");
        exit;

    } catch (PDOException $e) {
        // Handle any errors
        die("Error: " . $e->getMessage());
    }
}
?>
