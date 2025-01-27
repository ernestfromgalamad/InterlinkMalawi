<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_form.php");
    exit;
}

// Check if the service ID is set and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $service_id = $_GET['id'];

    // Include the database connection
    include 'db.php';

    try {
        // Prepare the SQL statement to fetch service details based on service_id
        $stmt = $pdo->prepare("SELECT * FROM services WHERE service_id = :service_id");
        $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if the service exists
        if ($stmt->rowCount() > 0) {
            // Fetch the service details
            $service = $stmt->fetch(PDO::FETCH_ASSOC);

            // Assign values to variables to pre-fill the form
            $service_name = $service['service_name'];
            $service_description = $service['service_description'];
            $service_type = $service['service_type'];
            $pricing = $service['pricing'];
            $delivery_time = $service['delivery_time'];
            $service_media = $service['service_media'];
            $tags = $service['tags'];
        } else {
            // Service not found, show error message
            echo "Service not found.";
            exit;
        }
    } catch (PDOException $e) {
        die("Error fetching service details: " . $e->getMessage());
    }
} else {
    // Invalid service ID, show error message
    echo "Invalid Service ID. Please check the URL or service ID.";
    exit;
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
    $service_media = $service_media; // Keep the existing media by default

    // Handle file upload
    if (isset($_FILES['service_media']) && $_FILES['service_media']['error'] == 0) {
        $media_name = $_FILES['service_media']['name'];
        $media_tmp_name = $_FILES['service_media']['tmp_name'];
        $media_path = 'uploads/' . basename($media_name);

        // Move the uploaded file to the desired location
        if (move_uploaded_file($media_tmp_name, $media_path)) {
            $service_media = $media_path; // Update media if new file is uploaded
        } else {
            die("Error uploading the file.");
        }
    }

    // Update the service in the database
    try {
        $stmt = $pdo->prepare("UPDATE services 
                               SET service_name = :service_name, 
                                   service_description = :service_description, 
                                   service_type = :service_type, 
                                   pricing = :pricing, 
                                   delivery_time = :delivery_time, 
                                   service_media = :service_media, 
                                   tags = :tags
                               WHERE service_id = :service_id");

        // Bind parameters
        $stmt->bindParam(':service_id', $service_id);
        $stmt->bindParam(':service_name', $service_name);
        $stmt->bindParam(':service_description', $service_description);
        $stmt->bindParam(':service_type', $service_type);
        $stmt->bindParam(':pricing', $pricing);
        $stmt->bindParam(':delivery_time', $delivery_time);
        $stmt->bindParam(':service_media', $service_media);
        $stmt->bindParam(':tags', $tags);

        // Execute the query
        $stmt->execute();

        // Redirect to my_services.php after successful update
        header("Location: my_services.php?message=success");
        exit;

    } catch (PDOException $e) {
        // Handle any errors
        die("Error: " . $e->getMessage());
    }
}
?>
