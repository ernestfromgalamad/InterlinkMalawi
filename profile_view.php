


<?php
session_start();


// if (!isset($_SESSION['user_id'])) {
  
//     header("Location: login_form.php");
//     exit;
// }
?>



<?php
// Include your database connection
include 'db.php';

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

// Check if the user is logged in and retrieve their ID from session
if (isset($_SESSION['user_id'])) {
    $artist_id = $_SESSION['user_id'];

    // Query to fetch artist details from the database
    try {
        $sql = "SELECT * FROM artists WHERE id = :artist_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if data was fetched
        if ($stmt->rowCount() > 0) {
            $artist = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Assign fetched values to variables for form pre-filling
            $first_name = sanitize($artist['first_name']);
            $last_name = sanitize($artist['last_name']);
            $email = sanitize($artist['email']);
            $phone_number = sanitize($artist['phone_number']);
            $biography = sanitize($artist['biography']);
            $genre = sanitize($artist['genre']);
            $portfolio = sanitize($artist['portfolio']);
            $social_media = sanitize($artist['social_media']);
            $achievements = sanitize($artist['achievements']);
            $address = sanitize($artist['address']);
            $country = sanitize($artist['country']);
            $currency = sanitize($artist['currency']);
            $profile_picture = sanitize($artist['profile_picture']);
        } else {
            // Handle case where artist data is not found
            echo "Artist data not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // echo "Session user_id not set.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - iLanding Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">iLanding</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#pricing">Pricing</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="index.html#about">Join Now!</a>

    </div>
  </header>

  <main class="main">

    


<?php
// Include your database connection
include 'db.php';



// Get the artist ID from the URL (e.g., shared_profile_2.php?id=1)
if (isset($_GET['id'])) {
    $artist_id = $_GET['id'];

    // Query to fetch artist details from the database for the given artist_id
    try {
        $sql = "SELECT * FROM artists WHERE id = :artist_id"; // Using artist_id in the WHERE clause
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['artist_id' => $artist_id]);

        // Check if data was fetched
        if ($stmt->rowCount() > 0) {
            $artist = $stmt->fetch(PDO::FETCH_ASSOC);

            // Assign fetched values to variables for display
            $first_name = sanitize($artist['first_name']);
            $last_name = sanitize($artist['last_name']);
            $email = sanitize($artist['email']);
            $phone_number = sanitize($artist['phone_number']);
            $biography = sanitize($artist['biography']);
            $genre = sanitize($artist['genre']);
            $portfolio = sanitize($artist['portfolio']);
            $social_media = sanitize($artist['social_media']);
            $achievements = sanitize($artist['achievements']);
            $address = sanitize($artist['address']);
            $country = sanitize($artist['country']);
            $currency = sanitize($artist['currency']);
            $profile_picture = sanitize($artist['profile_picture']);
            $education = sanitize($artist['education']);
            $expertise = sanitize($artist['expertise']);
            $awards = sanitize($artist['awards']);
            $skills = sanitize($artist['skills']);
            $projects = sanitize($artist['projects']);
        } else {
            echo "Artist not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Artist ID not provided.";
}
?>

<!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <!-- Artist Details and Profile Picture -->
            <div class="col-12 col-md-6 mb-4">
                <div class="profile-details d-flex flex-column align-items-center">
                    <!-- Profile Picture -->
                    <div class="profile-picture mb-3">
                        <?php if (!empty($profile_picture)): ?>
                            <img src="html/uploads/artists/<?php echo $profile_picture; ?>" alt="Profile Picture" class="img-thumbnail rounded-circle" width="150">
                        <?php else: ?>
                            <img src="path_to_default_image.jpg" alt="Default Profile Picture" class="img-thumbnail rounded-circle" width="150">
                        <?php endif; ?>
                    </div>

                    <!-- Personal Details -->
                    <div class="personal-details text-center">
                        <h3 class="artist-name">
                            <?php 
                            echo $first_name . ' ' . $last_name; 
                            
                            // Generate flag emoji using country code
                            $country_code = strtoupper(substr($country, 0, 2)); // Assuming country name is provided
                            $flag_emoji = mb_convert_encoding('&#' . (127397 + ord($country_code[0])) . '&#' . (127397 + ord($country_code[1])) . ';', 'UTF-8', 'HTML-ENTITIES');
                            
                            echo ' ' . $flag_emoji; 
                            ?>
                        </h3>
                        <p><i class="fas fa-envelope"></i> <?php echo $email; ?></p>
                        <p><i class="fas fa-phone"></i> <?php echo $phone_number; ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo $country; ?></p>

                        <!-- Social Media Icons -->
                        <div class="social-media mt-3">
                            <a href="https://facebook.com/<?php echo $facebook_username; ?>" class="me-2 text-primary" target="_blank">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            <a href="https://twitter.com/<?php echo $twitter_username; ?>" class="me-2 text-info" target="_blank">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a href="https://instagram.com/<?php echo $instagram_username; ?>" class="me-2 text-danger" target="_blank">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            <a href="https://linkedin.com/in/<?php echo $linkedin_username; ?>" class="me-2 text-primary" target="_blank">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                            <a href="https://wa.me/<?php echo $whatsapp_number; ?>" class="me-2 text-success" target="_blank">
                                <i class="fab fa-whatsapp fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcoming Banner with Message Me Button -->
            <div class="col-12 col-md-6 mb-4">
                <div class="welcome-banner d-flex align-items-center justify-content-center text-white p-4" 
                     style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); 
                            border-radius: 12px;">
                    <div class="banner-text text-center">
                        <h1 style="color: white;">Welcome to the Artist's Page</h1>
                        <p class="lead mb-3" style="color: #f0f0f0;">
                            Discover amazing art and connect with the artist. Whether you're looking to purchase original works or simply admire the creativity, you're in the right place. 
                        </p>
                        <!-- Message Me Button with Messenger Icon -->
                        <a href="#messageModal" class="btn btn-light mt-3" data-bs-toggle="modal" data-bs-target="#messageModal">
                            <i class="fas fa-paper-plane me-2"></i>Message Me
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="row">
            <div class="col-12">
                <hr>
                <div class="container section-title" >
    <h2>Explore Talent Profiles</h2>
    <p>Browse through the profiles of skilled professionals offering remote job opportunities and services worldwide. Whether you're looking for creative talent, technical expertise, or business solutions, you'll find the right match for your project needs.</p>
  </div><!-- End Section Title -->
             
                <div class="row">
                    <?php
                    // Fetching services offered by the artist
                    $stmt = $pdo->prepare("SELECT * FROM services WHERE user_id = :user_id ORDER BY created_at DESC");
                    $stmt->execute(['user_id' => $artist['id']]);

                    while ($service = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $service_name = htmlspecialchars($service['service_name']);
                        $service_description = htmlspecialchars($service['service_description']);
                        $service_media = htmlspecialchars($service['service_media']);
                        $pricing = htmlspecialchars($service['pricing']);
                        $delivery_time = htmlspecialchars($service['delivery_time']);
                    ?>
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="service-card shadow-sm h-100">
                                <img src="html/<?php echo $service_media; ?>" class="img-fluid" alt="Service Image" style="height: 200px; object-fit: cover;">
                                <div class="service-card-body">
                                    <h5 class="text-primary"><?php echo $service_name; ?></h5>
                                    <p><?php echo $service_description; ?></p>
                                    <p><strong>Price:</strong> $<?php echo $pricing; ?></p>
                                    <p><strong>Delivery Time:</strong> <?php echo $delivery_time; ?> hours</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Send a Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="send_message.php" method="POST">
                        <div class="mb-3">
                            <label for="messageSubject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="messageSubject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="messageContent" class="form-label">Message</label>
                            <textarea class="form-control" id="messageContent" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Add this to your CSS */
.welcome-banner {
    border-radius: 15px; /* Adjust the value for more or less rounding */
    overflow: hidden; /* Ensures content doesn't overflow the rounded corners */
}


</style>





<style>
    /* Profile section layout */
.profile-details {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.profile-picture {
    flex-shrink: 0;
    margin-right: 20px;
}

.personal-details {
    max-width: 500px;
}

.artist-name {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

/* Service cards layout */
.service-card {
    border: none;
    border-radius: 8px;
    overflow: hidden;
}

.service-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.service-card-body {
    padding: 15px;
}

</style>




<!-- Add the CSS for the love icon -->
<style>
/* Initially faint love icon color */
.love-icon {
    color: #ddd; /* Faint gray */
    transition: color 0.3s ease;
}

/* Change to red when clicked */
.love-icon.liked {
    color: red; /* Red when clicked */
}
</style>







</main>


<style>
    /* Make the love icon faint by default */
.love-icon {
    opacity: 0.5;
    transition: opacity 0.3s ease-in-out;
}

/* Make the love icon full when clicked or active */
.love-icon.liked {
    opacity: 1;
}

</style>
  

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>