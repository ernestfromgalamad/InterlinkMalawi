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

// Retrieve the fullname from the artists table
try {
    $stmt = $pdo->prepare("SELECT CONCAT(first_name, ' ', last_name) AS fullname FROM artists WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $artist = $stmt->fetch(PDO::FETCH_ASSOC);
    $fullname = $artist['fullname'];
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get POST values
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    $service_type = $_POST['service_type'];
    $pricing = $_POST['pricing'];
    $delivery_time = $_POST['delivery_time'];
    $tags = $_POST['tags'];
    $service_media = null;

    // Handle file upload
    if (isset($_FILES['service_media']) && $_FILES['service_media']['error'] == 0) {
        $media_name = $_FILES['service_media']['name'];
        $media_tmp_name = $_FILES['service_media']['tmp_name'];
        $media_path = 'uploads/services/' . basename($media_name);

        // Move the uploaded file to the desired location
        if (move_uploaded_file($media_tmp_name, $media_path)) {
            $service_media = $media_path;
        } else {
            die("Error uploading the file.");
        }
    }

    // Insert the service into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO services (user_id, fullname, service_name, service_description, service_type, pricing, delivery_time, service_media, tags) 
                               VALUES (:user_id, :fullname, :service_name, :service_description, :service_type, :pricing, :delivery_time, :service_media, :tags)");

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':service_name', $service_name);
        $stmt->bindParam(':service_description', $service_description);
        $stmt->bindParam(':service_type', $service_type);
        $stmt->bindParam(':pricing', $pricing);
        $stmt->bindParam(':delivery_time', $delivery_time);
        $stmt->bindParam(':service_media', $service_media);
        $stmt->bindParam(':tags', $tags);

        // Execute the query
        $stmt->execute();

        // Redirect to services.php after successful insertion
        header("Location: my_services.php?message=success");
        exit;

    } catch (PDOException $e) {
        // Handle any errors
        die("Error: " . $e->getMessage());
    }
}
?>
