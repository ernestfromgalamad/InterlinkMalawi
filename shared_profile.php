


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
    echo "Session user_id not set.";
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

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <div class="company-badge mb-4">
                <i class="bi bi-gear-fill me-2"></i>
                Working for your success
              </div>

              <h1 class="mb-4">
              Find Experts, <br>
              Deliver Excellence, We Connect you to the <br>
                <span class="accent-text">Right people</span>
              </h1>

              <p class="mb-4 mb-md-5">
              Explore the wealth of knowledge and opportunities available on our platform.
               Connect with leading experts in the field and ensure that your skills stay competitive in this ever-evolving landscape.
              </p>

              <div class="hero-buttons">
                <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Signup to add Services</a>
                <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-link mt-2 mt-sm-0 glightbox">
                  <i class="bi bi-play-circle me-1"></i>
                  Play Video
                </a> -->
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="assets/img/illustration-1.webp" alt="Hero Image" class="img-fluid">

              <div class="customers-badge">
                <div class="customer-avatars">
                  <img src="assets/img/avatar-1.webp" alt="Customer 1" class="avatar">
                  <img src="assets/img/avatar-2.webp" alt="Customer 2" class="avatar">
                  <img src="assets/img/avatar-3.webp" alt="Customer 3" class="avatar">
                  <img src="assets/img/avatar-4.webp" alt="Customer 4" class="avatar">
                  <img src="assets/img/avatar-5.webp" alt="Customer 5" class="avatar">
                  <span class="avatar more">12+</span>
                </div>
                <p class="mb-0 mt-2">12,000+ lorem ipsum dolor sit amet consectetur adipiscing elit</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-trophy"></i>
              </div>
              <div class="stat-content">
                <h4>3x Won Awards</h4>
                <p class="mb-0">Vestibulum ante ipsum</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-briefcase"></i>
              </div>
              <div class="stat-content">
                <h4>6.5k Faucibus</h4>
                <p class="mb-0">Nullam quis ante</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-graph-up"></i>
              </div>
              <div class="stat-content">
                <h4>80k Mauris</h4>
                <p class="mb-0">Etiam sit amet orci</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-award"></i>
              </div>
              <div class="stat-content">
                <h4>6x Phasellus</h4>
                <p class="mb-0">Vestibulum ante ipsum</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <section class="blank-section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Our Artists</h2>
        <p>Explore profiles of talented artists from around the globe.</p>
    </div><!-- End Section Title -->

    <!-- Artists -->
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        // Fetch artist details from the database
        $stmt = $pdo->prepare("SELECT first_name, last_name, profile_picture, country FROM `artists` ORDER BY created_at DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $full_name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
            $country = htmlspecialchars($row['country']);
            $profile_picture = htmlspecialchars($row['profile_picture']);

            // Default profile picture if none is uploaded
            if (empty($profile_picture)) {
                $profile_picture = 'uploads/artists/default_picture_old.jpg';
            } else {
                $profile_picture = 'uploads/artists/' . $profile_picture;
            }
        ?>
            <div class="col mb-4">
                <div class="card h-100 d-flex align-items-center justify-content-center" style="border: none; padding: 15px; background-color: #f8f9fa; border-radius: 10px;">
                    <!-- Flex Container -->
                    <div class="d-flex align-items-center">
                        <!-- Profile Picture -->
                        <img src="<?php echo $profile_picture; ?>" alt="<?php echo $full_name; ?>" 
                             class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                        
                        <!-- Artist Name and Country -->
                        <div>
                            <h5 class="mb-1"><?php echo $full_name; ?></h5>
                            <p class="text-muted mb-0"><?php echo $country; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>

<!-- Features Cards Section -->
<section id="features-cards" class="features-cards section">

<div class="container">

  <div class="row gy-4">

    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
      <div class="feature-box orange">
        <i class="bi bi-award"></i>
        <h4>Corporis voluptates</h4>
        <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
      </div>
    </div><!-- End Feature Borx-->

    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
      <div class="feature-box blue">
        <i class="bi bi-patch-check"></i>
        <h4>Explicabo consectetur</h4>
        <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>
      </div>
    </div><!-- End Feature Borx-->

    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
      <div class="feature-box green">
        <i class="bi bi-sunrise"></i>
        <h4>Ullamco laboris</h4>
        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
      </div>
    </div><!-- End Feature Borx-->

    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
      <div class="feature-box red">
        <i class="bi bi-shield-check"></i>
        <h4>Labore consequatur</h4>
        <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
      </div>
    </div><!-- End Feature Borx-->

  </div>

</div>

</section><!-- /Features Cards Section -->

<section class="blank-section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Featured Services</h2>
    <p>Discover creative services and projects posted by talented artists from various genres.</p>
</div><!-- End Section Title -->


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
            echo "Artist data not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Session user_id not set.";
}
?>

<!-- / Navbar -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Profile Picture and Personal Details -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Personal Details</h5>
                    </div>
                    <div class="card-body text-center">
                        <!-- Profile Picture -->
                        <div class="mb-3 d-flex justify-content-center">
                            <?php if (!empty($profile_picture)): ?>
                                <img src="uploads/artists/<?php echo $profile_picture; ?>" alt="Profile Picture" class="img-thumbnail rounded-circle" width="150">
                            <?php else: ?>
                                <img src="path_to_default_image.jpg" alt="Default Profile Picture" class="img-thumbnail rounded-circle" width="150">
                            <?php endif; ?>
                        </div>
                        <!-- Personal Details -->
                        <p><strong>Name:</strong> <?php echo $first_name . ' ' . $last_name; ?></p>
                        <p><strong>Email:</strong> <?php echo $email; ?></p>
                        <p><strong>Phone Number:</strong> <?php echo $phone_number; ?></p>
                        <p><strong>Country:</strong> <?php echo $country; ?></p>
                        <p><strong>Preferred Currency:</strong> <?php echo $currency; ?></p>
                    </div>
                </div>
            </div>

            <!-- Professional Details -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Professional Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Biography:</strong> <?php echo $biography; ?></p>
                        <p><strong>Primary Genre:</strong> <?php echo $genre; ?></p>
                        <p><strong>Portfolio:</strong> <a href="<?php echo $portfolio; ?>" target="_blank"><?php echo $portfolio; ?></a></p>
                        <p><strong>Social Media:</strong> <?php echo $social_media; ?></p>
                        <p><strong>Achievements:</strong> <?php echo $achievements; ?></p>
                        <p><strong>Education:</strong> <?php echo $education; ?></p>
                        <p><strong>Expertise:</strong> <?php echo $expertise; ?></p>
                        <p><strong>Awards:</strong> <?php echo $awards; ?></p>
                        <p><strong>Skills:</strong> <?php echo $skills; ?></p>
                        <p><strong>Projects:</strong> <?php echo $projects; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Services Offered</h5>
                    </div>
                    <div class="card-body">
                    <div class="row">
            <?php
            // Assuming $_SESSION['user_id'] contains the logged-in user's ID
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                // Prepare and execute the query to fetch only services for the logged-in user
                $stmt = $pdo->prepare("SELECT * FROM `services` WHERE `user_id` = :user_id ORDER BY `created_at` DESC");
                $stmt->execute(['user_id' => $user_id]);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $service_name = htmlspecialchars($row['service_name']);
                    $service_description = htmlspecialchars($row['service_description']);
                    $service_media = htmlspecialchars($row['service_media']);
                    $created_at = htmlspecialchars($row['created_at']);
                    $tags = htmlspecialchars($row['tags']);
                    $pricing = htmlspecialchars($row['pricing']);
                    $delivery_time = htmlspecialchars($row['delivery_time']);
            ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <!-- Image Thumbnail -->
                            <img src="<?php echo $service_media; ?>" class="card-img-top img-thumbnail" alt="Service Image" style="width: 100%; height: 200px; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $row['service_id']; ?>">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?php echo $service_name; ?></h5>
                                <p class="card-text"><?php echo $service_description; ?></p>
                                <p><strong>Price:</strong> $<?php echo $pricing; ?></p>
                                <p><strong>Delivery Time:</strong> <?php echo $delivery_time; ?> hours</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- <small class="text-muted">Created on: <?php echo date('F j, Y', strtotime($created_at)); ?></small> -->
                                    <!-- Edit and Delete Buttons -->
                                    <div>
                                        <!-- <a href="edit_service.php?id=<?php echo $row['service_id']; ?>" class="btn btn-sm btn-outline-warning">Edit</a> -->
                                        <!-- <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['service_id']; ?>">Delete</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Image Full View -->
                    <div class="modal fade" id="imageModal<?php echo $row['service_id']; ?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel"><?php echo $service_name; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="<?php echo $service_media; ?>" class="img-fluid" alt="Full Service Image">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal<?php echo $row['service_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this service?</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="delete_service.php">
                                        <input type="hidden" name="service_id" value="<?php echo $row['service_id']; ?>">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php } } else { ?>
                <p>You must be logged in to view your services.</p>
            <?php } ?>
        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>

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


<!-- About Section -->
<section id="about" class="about section">

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="row gy-4 align-items-center justify-content-between">

    <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
      <span class="about-meta">MORE ABOUT US</span>
      <h2 class="about-title">Voluptas enim suscipit temporibus</h2>
      <p class="about-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>

      <div class="row feature-list-wrapper">
        <div class="col-md-6">
          <ul class="feature-list">
            <li><i class="bi bi-check-circle-fill"></i> Lorem ipsum dolor sit amet</li>
            <li><i class="bi bi-check-circle-fill"></i> Consectetur adipiscing elit</li>
            <li><i class="bi bi-check-circle-fill"></i> Sed do eiusmod tempor</li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="feature-list">
            <li><i class="bi bi-check-circle-fill"></i> Incididunt ut labore et</li>
            <li><i class="bi bi-check-circle-fill"></i> Dolore magna aliqua</li>
            <li><i class="bi bi-check-circle-fill"></i> Ut enim ad minim veniam</li>
          </ul>
        </div>
      </div>

      <div class="info-wrapper">
        <div class="row gy-4">
          <div class="col-lg-5">
            <div class="profile d-flex align-items-center gap-3">
              <img src="assets/img/avatar-1.webp" alt="CEO Profile" class="profile-image">
              <div>
                <h4 class="profile-name">Mario Smith</h4>
                <p class="profile-position">CEO &amp; Founder</p>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="contact-info d-flex align-items-center gap-2">
              <i class="bi bi-telephone-fill"></i>
              <div>
                <p class="contact-label">Call us anytime</p>
                <p class="contact-number">+123 456-789</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
      <div class="image-wrapper">
        <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
          <img src="assets/img/about-5.webp" alt="Business Meeting" class="img-fluid main-image rounded-4">
          <img src="assets/img/about-2.webp" alt="Team Discussion" class="img-fluid small-image rounded-4">
        </div>
        <div class="experience-badge floating">
          <h3>15+ <span>Years</span></h3>
          <p>Of experience in business service</p>
        </div>
      </div>
    </div>
  </div>

</div>

</section><!-- /About Section -->






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