


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
    <li><a href="index.php#hero" class="active">Home</a></li>
    <!-- <li><a href="#about">About</a></li> -->
    <li><a href="index.php#featured-talents">Featured Talents</a></li>
    <li><a href="index.php#featured-services">Featured Services</a></li>
    <li><a href="index.php#featured-projects">Explore Projects</a></li>
    <!-- <li class="dropdown"><a href="#"><span>Resources</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Tutorials</a></li>
      </ul>
    </li> -->
    <li><a href="index.php#about">About</a></li>
  </ul>
  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
      <a class="btn-getstarted" href="html/create_account_form.php">Join Now!</a>

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
                    <h1 style="color: white;">Welcome to My Page</h1>
                    <p class="lead mb-3" style="color: #f0f0f0;">
                        Explore the range of specialized services I provide, designed to meet your unique needs. 
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
                    <h2>My Services</h2>
                    <p>I offer a diverse array of professional services tailored to help you achieve your goals. I am committed to delivering exceptional results with every project.</p>
                </div><!-- End Section Title -->
             
                <div class="row g-4">
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
                        <div class="col-12 col-md-4 col-lg-3 mb-4">
                            <div class="service-card shadow-sm h-100">
                                <img src="html/<?php echo $service_media; ?>" class="img-fluid" alt="Service Image" style="height: 200px; object-fit: cover;">
                                <div class="service-card-body p-3">
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
    /* Ensure cards take full width while maintaining responsive behavior */
    .service-card {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .service-card img {
        object-fit: cover;
        max-height: 200px; /* Prevent the image from stretching too much */
    }
    .service-card-body {
        padding: 1.5rem; /* Increase padding for better spacing */
    }

    .row.g-4 .col-12 {
        width: 100%; /* Allow the card to span the full width of the row */
    }
</style>



<section id="featured-projects" class="blank-section" style="background-color: rgba(211, 211, 211, 0.05);">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>My Previos Projects</h2>
        <p>Discover projects posted by talented artists from various genres.</p>
    </div><!-- End Section Title -->

    <!-- Projects -->
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            // Check if artist ID is provided in the URL
            if (isset($_GET['id'])) {
                $artist_id = $_GET['id']; // Ensure this value is sanitized in a production environment

                // Fetch projects for the specific artist
                $stmt = $pdo->prepare("
                    SELECT 
                        p.id AS project_id, p.project_name, p.project_description, p.project_media, p.created_at,
                        CONCAT(a.first_name, ' ', a.last_name) AS fullname, a.profile_picture, a.id AS user_id
                    FROM `projects` p 
                    LEFT JOIN `artists` a ON p.user_id = a.id 
                    WHERE a.id = :artist_id
                    ORDER BY p.created_at DESC
                ");
                $stmt->execute(['artist_id' => $artist_id]);

                // Check if any projects are available
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Sanitize and assign variables
                        $project_id = htmlspecialchars($row['project_id']);
                        $project_name = htmlspecialchars($row['project_name']);
                        $project_description = htmlspecialchars($row['project_description']);
                        $project_media = htmlspecialchars($row['project_media']);
                        $created_at = htmlspecialchars($row['created_at']);
                        $fullname = htmlspecialchars($row['fullname']);
                        $artist_profile_picture = htmlspecialchars($row['profile_picture']);
                        $user_id = htmlspecialchars($row['user_id']);

                        // Default profile picture handling
                        if (empty($artist_profile_picture)) {
                            $artist_profile_picture = 'html/uploads/artists/default_picture_old.jpg';
                        } else {
                            $artist_profile_picture = 'html/uploads/artists/' . $artist_profile_picture;
                        }

                        // Media path validation
                        $project_media_path = "html/" . $project_media;
                        if (!file_exists($project_media_path) || empty($project_media)) {
                            $project_media_path = "html/uploads/default_project_image.jpg"; // Fallback image
                        }
            ?>
            <div class="col mb-4">
                <div class="card h-100" style="font-size: 1rem; border: none;">
                    <div class="position-relative">
                        <img src="<?php echo $project_media_path; ?>" 
                             class="card-img-top img-thumbnail" 
                             alt="Project Image" 
                             style="width: 100%; height: 200px; object-fit: cover;" 
                             data-bs-toggle="modal" 
                             data-bs-target="#projectModal<?php echo $project_id; ?>">

                        <!-- Love Icon -->
                        <a href="your_backend_php_script.php?project_id=<?php echo $project_id; ?>" 
                           class="position-absolute top-0 end-0 p-2 love-icon" 
                           style="font-size: 1.5rem;" 
                           onclick="this.classList.toggle('liked')">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- Wrap the project name in a link to the artist's profile -->
                        <h6 class="card-title mb-2"><?php echo $project_name; ?></h6>
                        <!-- <div class="d-flex justify-content-between align-items-center">
                            <div>
                                
                                <a href="profile_view.php?id=<?php echo $user_id; ?>">
                                    <img src="<?php echo $artist_profile_picture; ?>" 
                                         alt="Artist Picture" 
                                         class="rounded-circle" 
                                         style="width: 30px; height: 30px;">
                                </a>
                                <a href="profile_view.php?id=<?php echo $user_id; ?>" 
                                   class="text-muted"><?php echo $fullname; ?></a>
                            </div>
                            <small class="text-muted"><?php echo date('F j, Y', strtotime($created_at)); ?></small>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Modal for Image Full View -->
            <div class="modal fade" id="projectModal<?php echo $project_id; ?>" tabindex="-1" aria-labelledby="projectModalLabel<?php echo $project_id; ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="projectModalLabel<?php echo $project_id; ?>"><?php echo $project_name; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="<?php echo $project_media_path; ?>" class="img-fluid" alt="Full Project Image">
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo "<p class='text-center'>No projects found for this artist.</p>";
                }
            } else {
                echo "<p class='text-center'>No artist ID provided in the URL.</p>";
            }
            ?>
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