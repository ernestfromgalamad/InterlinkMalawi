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
    // Get artist data from the form
    $first_name = sanitize($_POST['firstName']);
    $last_name = sanitize($_POST['lastName']);
    $email = sanitize($_POST['email']);
    $phone_number = sanitize($_POST['phoneNumber']);
    $biography = sanitize($_POST['biography']);
    $genre = sanitize($_POST['genre']);
    $portfolio = sanitize($_POST['portfolio']);
    $social_media = sanitize($_POST['socialMedia']);
    $achievements = sanitize($_POST['achievements']);
    $address = sanitize($_POST['address']);
    $country = sanitize($_POST['country']);
    $currency = sanitize($_POST['currency']);
    $education = sanitize($_POST['education']);
    $expertise = sanitize($_POST['expertise']);
    $awards = sanitize($_POST['awards']);
    $projects = sanitize($_POST['projects']);
    $facebook = sanitize($_POST['facebook']);
    $whatsapp = sanitize($_POST['whatsapp']);
    $instagram = sanitize($_POST['instagram']);
    $twitter = sanitize($_POST['twitter']);
    $linkedin = sanitize($_POST['linkedin']);
    $main_profession = sanitize($_POST['mainProfession']);
    $other_professions = sanitize($_POST['otherProfessions']);

    // Handle multiple skills
    $skills = [];
    if (!empty($_POST['skills']) && is_array($_POST['skills'])) {
        foreach ($_POST['skills'] as $skill) {
            $skills[] = sanitize($skill);
        }
    }
    $skills_json = json_encode($skills);

    // Handle profile picture upload (from base64 if available)
    $profile_picture = null;
    if (!empty($_POST['croppedImageData'])) {
        // If a cropped image is provided in base64
        $base64_image = $_POST['croppedImageData'];

        // Extract the image data (remove 'data:image/png;base64,' part)
        $image_data = explode(',', $base64_image)[1];

        // Decode the base64 string to binary data
        $decoded_data = base64_decode($image_data);

        // Create a unique file name
        $profile_picture = 'profile_picture_' . uniqid() . '.png';

        // Set the target directory
        $target_dir = "uploads/artists/";

        // Save the image as a PNG file
        $target_file = $target_dir . $profile_picture;
        if (file_put_contents($target_file, $decoded_data) === false) {
            $_SESSION['message'] = ['error' => 'Error uploading cropped profile picture.'];
            header('Location: artist_account.php');
            exit();
        }
    } else {
        // Handle regular file upload (if no cropped image)
        if (!empty($_FILES['profilePicture']['name'])) {
            $profile_picture = $_FILES['profilePicture']['name'];
            $target_dir = "uploads/artists/";
            $target_file = $target_dir . basename($profile_picture);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageFileType, $allowed_types)) {
                if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_file)) {
                    $_SESSION['message'] = ['error' => 'Error uploading profile picture.'];
                    header('Location: artist_account.php');
                    exit();
                }
            } else {
                $_SESSION['message'] = ['error' => 'Only image files are allowed for profile picture.'];
                header('Location: artist_account.php');
                exit();
            }
        }
    }

    // Default profile picture handling if no file is uploaded
    if (!$profile_picture) {
        $artist_id = $_SESSION['user_id'];
        try {
            $sql = "SELECT profile_picture FROM artists WHERE id = :artist_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
            $stmt->execute();
            $artist = $stmt->fetch(PDO::FETCH_ASSOC);
            $profile_picture = $artist['profile_picture'];
        } catch (PDOException $e) {
            $_SESSION['message'] = ['error' => 'Error fetching current profile picture.'];
            header('Location: artist_account.php');
            exit();
        }
    }

    // Insert or update artist details in the database
    try {
        $sql = "UPDATE artists SET 
                first_name = :first_name, 
                last_name = :last_name, 
                email = :email, 
                phone_number = :phone_number, 
                biography = :biography, 
                genre = :genre, 
                portfolio = :portfolio, 
                social_media = :social_media, 
                achievements = :achievements, 
                address = :address, 
                country = :country, 
                currency = :currency, 
                education = :education, 
                expertise = :expertise, 
                awards = :awards, 
                skills = :skills, 
                projects = :projects, 
                facebook = :facebook, 
                whatsapp = :whatsapp, 
                instagram = :instagram, 
                twitter = :twitter, 
                linkedin = :linkedin, 
                main_profession = :main_profession, 
                other_professions = :other_professions, 
                profile_picture = :profile_picture 
                WHERE id = :artist_id";
                
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':biography', $biography);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':portfolio', $portfolio);
        $stmt->bindParam(':social_media', $social_media);
        $stmt->bindParam(':achievements', $achievements);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':currency', $currency);
        $stmt->bindParam(':education', $education);
        $stmt->bindParam(':expertise', $expertise);
        $stmt->bindParam(':awards', $awards);
        $stmt->bindParam(':skills', $skills_json);
        $stmt->bindParam(':projects', $projects);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':whatsapp', $whatsapp);
        $stmt->bindParam(':instagram', $instagram);
        $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':main_profession', $main_profession);
        $stmt->bindParam(':other_professions', $other_professions);
        $stmt->bindParam(':profile_picture', $profile_picture);
        $stmt->bindParam(':artist_id', $_SESSION['user_id'], PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Set success message
        $_SESSION['message'] = ['success' => 'Artist details updated successfully.'];
    } catch (PDOException $e) {
        $_SESSION['message'] = ['error' => 'Error updating artist details: ' . $e->getMessage()];
    }

    // Redirect back to the artist account page
    header('Location: artist_account.php');
    exit();
}
?>
