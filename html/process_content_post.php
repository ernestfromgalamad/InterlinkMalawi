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
$artist_id = $_SESSION['user_id'];  // Assuming `user_id` corresponds to `artist_id` in the artists table

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get POST values
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $tags = $_POST['tags'];
    $visibility = $_POST['visibility'];
    $specific_users = null;

    // Handle file upload
    if (isset($_FILES['media']) && $_FILES['media']['error'] == 0) {
        $media_name = $_FILES['media']['name'];
        $media_tmp_name = $_FILES['media']['tmp_name'];
        $media_path = 'uploads/' . basename($media_name);

        // Move the uploaded file to the desired location
        if (move_uploaded_file($media_tmp_name, $media_path)) {
            // File uploaded successfully
        } else {
            die("Error uploading the file.");
        }
    } else {
        $media_path = null; // No media uploaded
    }

    // Handle specific users (if visibility is 'specific-users')
    if ($visibility === 'specific-users' && isset($_POST['specific_users'])) {
        $specific_users = $_POST['specific_users'];
    }

    // Insert the content into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO content (artist_id, title, description, category, media, tags, visibility, specific_users) 
                               VALUES (:artist_id, :title, :description, :category, :media, :tags, :visibility, :specific_users)");

        // Bind parameters
        $stmt->bindParam(':artist_id', $artist_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':media', $media_path);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':visibility', $visibility);
        $stmt->bindParam(':specific_users', $specific_users);

        // Execute the query
        $stmt->execute();

        // Redirect with success message
        header("Location: artist_profile.php?message=success");
        exit;

    } catch (PDOException $e) {
        // Handle any errors
        die("Error: " . $e->getMessage());
    }
}
?>
