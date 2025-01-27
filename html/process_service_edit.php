<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit;
}

// Include the database connection
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize the form inputs
    $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : '';
    $service_name = isset($_POST['service_name']) ? trim($_POST['service_name']) : '';
    $service_description = isset($_POST['service_description']) ? trim($_POST['service_description']) : '';
    $service_type = isset($_POST['service_type']) ? $_POST['service_type'] : '';
    $pricing = isset($_POST['pricing']) ? $_POST['pricing'] : 0;
    $delivery_time = isset($_POST['delivery_time']) ? $_POST['delivery_time'] : 0;
    $tags = isset($_POST['tags']) ? trim($_POST['tags']) : '';
    $service_media = isset($_FILES['service_media']) ? $_FILES['service_media'] : null;

    // Check if required fields are provided
    if (empty($service_name) || empty($service_description) || empty($service_type) || empty($pricing) || empty($delivery_time)) {
        die("All fields are required.");
    }

    try {
        // Get the current media URL from the database
        $sql = "SELECT service_media FROM services WHERE service_id = :service_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
        $stmt->execute();
        $service = $stmt->fetch(PDO::FETCH_ASSOC);

        // If no new media file is uploaded, retain the current media
        if ($service_media && $service_media['error'] == 0) {
            // Define target directory for media uploads
            $target_dir = "uploads/services/";
            $target_file = $target_dir . basename($service_media['name']);
            $upload_ok = 1;
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file is a valid image, video, or PDF
            if (!in_array($file_type, ['jpg', 'png', 'jpeg', 'gif', 'mp4', 'pdf'])) {
                $upload_ok = 0;
                die("Only JPG, JPEG, PNG, GIF, MP4, and PDF files are allowed.");
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                $upload_ok = 0;
                die("Sorry, file already exists.");
            }

            // Check if file size is within the limit (5MB)
            if ($service_media['size'] > 5000000) {
                $upload_ok = 0;
                die("Sorry, your file is too large.");
            }

            // Attempt to upload file if all checks pass
            if ($upload_ok == 1 && move_uploaded_file($service_media['tmp_name'], $target_file)) {
                // Successfully uploaded file, update service_media URL
                $service_media_url = $target_file;
            } else {
                die("Sorry, there was an error uploading your file.");
            }
        } else {
            // If no new media is uploaded, use the existing media URL
            $service_media_url = $service['service_media'];
        }

        // Update service details in the database
        $sql = "UPDATE services SET
                    service_name = :service_name,
                    service_description = :service_description,
                    service_type = :service_type,
                    pricing = :pricing,
                    delivery_time = :delivery_time,
                    tags = :tags,
                    service_media = :service_media
                WHERE service_id = :service_id";

        // Prepare and execute the SQL statement
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':service_name', $service_name, PDO::PARAM_STR);
        $stmt->bindParam(':service_description', $service_description, PDO::PARAM_STR);
        $stmt->bindParam(':service_type', $service_type, PDO::PARAM_STR);
        $stmt->bindParam(':pricing', $pricing, PDO::PARAM_STR);
        $stmt->bindParam(':delivery_time', $delivery_time, PDO::PARAM_INT);
        $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
        $stmt->bindParam(':service_media', $service_media_url, PDO::PARAM_STR);
        $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to services page with success message
            header("Location: my_services.php?message=Service updated successfully.");
        } else {
            die("Error updating service.");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
