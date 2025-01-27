


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
    <!-- <li><a href="#about">About</a></li> -->
    <li><a href="#featured-talents">Featured Talents</a></li>
    <li><a href="#featured-services">Featured Services</a></li>
    <li><a href="#featured-projects">Explore Projects</a></li>
    <!-- <li class="dropdown"><a href="#"><span>Resources</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Tutorials</a></li>
      </ul>
    </li> -->
    <li><a href="#about">About</a></li>
  </ul>
  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

<a class="btn-getstarted" href="index.html#about">
    <i class="fas fa-sign-in-alt"></i> Sign in
</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
            <!-- <div class="company-badge mb-4">
  <a href="signup_page_url_here" class="text-decoration-none">
    <i class="bi bi-person-plus me-2"></i>
    Working for your success
  </a>
</div> -->


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
                <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Join as a professional</a>
                <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-link mt-2 mt-sm-0 glightbox">
                  <i class="bi bi-play-circle me-1"></i>
                  Play Video
                </a> -->
              </div>
            </div>
          </div>

          <div class="col-lg-6">
  <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
    <img src="assets/img/illustration-1.png" alt="Hero Image" class="img-fluid">

    <div class="customers-badge">
      <div class="customer-avatars">
        <img src="assets/img/avatar-1.webp" alt="Customer 1" class="avatar">
        <img src="assets/img/avatar-2.webp" alt="Customer 2" class="avatar">
        <img src="assets/img/avatar-3.webp" alt="Customer 3" class="avatar">
        <img src="assets/img/avatar-4.webp" alt="Customer 4" class="avatar">
        <img src="assets/img/avatar-5.webp" alt="Customer 5" class="avatar">
        <span class="avatar more">12+</span>
      </div>
      <p class="mb-0 mt-2">A growing community of professionals offering expertise across diverse fields</p>
    </div>
  </div>
</div>
</div>

<!-- Stats Row Section -->
<div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
  <div class="col-lg-3 col-md-6">
    <div class="stat-item">
      <div class="stat-icon">
        <i class="bi bi-laptop"></i>
      </div>
      <div class="stat-content">
        <h4>Tech Experts</h4>
        <p class="mb-0">Providing software development, IT solutions, and cybersecurity services</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="stat-item">
      <div class="stat-icon">
        <i class="bi bi-pencil"></i>
      </div>
      <div class="stat-content">
        <h4>Content Creators</h4>
        <p class="mb-0">Experienced writers, editors, and content strategists</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="stat-item">
      <div class="stat-icon">
        <i class="bi bi-palette"></i>
      </div>
      <div class="stat-content">
        <h4>Designers</h4>
        <p class="mb-0">Talented graphic designers, UI/UX experts, and animators</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="stat-item">
      <div class="stat-icon">
        <i class="bi bi-bar-chart-line"></i>
      </div>
      <div class="stat-content">
        <h4>Marketing Professionals</h4>
        <p class="mb-0">Experts in digital marketing, SEO, and social media management</p>
      </div>
    </div>
  </div>
</div>

      </div>

    </section><!-- /Hero Section -->
    
    <section id="featured-talents" class="blank-section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up" style="background-color: #e7f9ff; padding: 20px;">
    <h2>Explore Talent Profiles</h2>
    <p>Browse through the profiles of skilled professionals offering remote job opportunities and services worldwide. Whether you're looking for creative talent, technical expertise, or business solutions, you'll find the right match for your project needs.</p>
  </div><!-- End Section Title -->

  <!-- Artists -->
  <div class="container py-4" style="background-color: #e7f9ff; padding: 20px;">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php
    // Fetch artist details from the database
    $stmt = $pdo->prepare("SELECT id, first_name, last_name, profile_picture, country, main_profession FROM `artists` ORDER BY created_at DESC");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = htmlspecialchars($row['id']); // Use the `id` column as the unique identifier
        $full_name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
        $country = htmlspecialchars($row['country']);
        $main_profession = htmlspecialchars($row['main_profession']);
        $profile_picture = htmlspecialchars($row['profile_picture']);

        // Default profile picture if none is uploaded
        if (empty($profile_picture)) {
            $profile_picture = 'html/uploads/artists/default_picture_old.jpg';
        } else {
            $profile_picture = 'html/uploads/artists/' . $profile_picture;
        }

        // Construct the link to the artist's profile
        $profile_url = "profile_view.php?id=" . urlencode($id);
    ?>
        <div class="col mb-4">
            <!-- Profile Card as a Clickable Link -->
            <a href="<?php echo $profile_url; ?>" class="text-decoration-none text-dark">
                <div class="card h-100 d-flex align-items-center justify-content-center" style="border: none; padding: 15px; border-radius: 10px; background-color: transparent;">
                    <!-- Flex Container -->
                    <div class="d-flex align-items-center">
                        <!-- Profile Picture -->
                        <img src="<?php echo $profile_picture; ?>" alt="<?php echo $full_name; ?>" 
                             class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                        
                        <!-- Artist Details -->
                        <div>
                            <!-- Artist Name (Bold) -->
                            <h5 class="mb-1" style="font-weight: bold;"><?php echo $full_name; ?></h5>
                            
                            <!-- Main Profession and Country in one line -->
                            <h6 class="mb-1" style="color: #007bff;"><?php echo $main_profession . ', ' . $country; ?></h6>
                            
                            <!-- Star Rating -->
                            <div class="mb-1">
                                <?php
                                $rating = 3; // Example rating value; replace with a database value if needed
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        echo '<i class="fas fa-star text-warning"></i>'; // Filled star
                                    } else {
                                        echo '<i class="fas fa-star text-muted"></i>'; // Faint star
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
    </div>
  </div>
</section>



<section id="featured-services" class="blank-section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Featured Services</h2>
        <p>Explore a wide array of professional services and projects posted by experts across multiple industries. 
            From innovative designs and captivating artwork to advanced software development, technical consulting, 
            and expert writing, our platform brings together a diverse group of talented individuals. Whether you’re 
            seeking creative solutions, business strategies, or specialized professional services, you’ll find a range of 
            skilled professionals ready to collaborate and help you bring your ideas to life. Join our growing community and
            discover unique offerings from a variety of fields, all in one place.</p>
    </div>
    <!-- End Section Title -->

    <!-- Services -->
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        // Fetch all services and the corresponding artist details from the database
        $stmt = $pdo->prepare("SELECT s.*, CONCAT(a.first_name, ' ', a.last_name) AS fullname, a.profile_picture 
                               FROM `services` s 
                               LEFT JOIN `artists` a ON s.user_id = a.id 
                               ORDER BY s.created_at DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $service_name = htmlspecialchars($row['service_name']);
            $service_description = htmlspecialchars($row['service_description']);
            $service_media = htmlspecialchars($row['service_media']);
            $created_at = htmlspecialchars($row['created_at']);
            $pricing = htmlspecialchars($row['pricing']);
            $delivery_time = htmlspecialchars($row['delivery_time']);
            $fullname = htmlspecialchars($row['fullname']);
            $artist_profile_picture = htmlspecialchars($row['profile_picture']);
            if (empty($artist_profile_picture)) {
                $artist_profile_picture = 'html/uploads/artists/default_picture_old.jpg';
            } else {
                $artist_profile_picture = 'html/uploads/artists/' . $artist_profile_picture;
            }
        ?>
            <div class="col mb-4">
                <div class="card h-100" style="font-size: 1rem; border: none; background-color: rgba(173, 216, 230, 0.2);">
                    <div class="position-relative">
                        <img src="html/<?php echo $service_media; ?>" class="card-img-top img-thumbnail" alt="Service Image" style="width: 100%; height: 200px; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $row['service_id']; ?>">

                        <!-- Love Icon -->
                        <a href="your_backend_php_script.php?service_id=<?php echo $row['service_id']; ?>" class="position-absolute top-0 end-0 p-2 love-icon" style="font-size: 1.5rem;" onclick="this.classList.toggle('liked')">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-2"><?php echo $service_name; ?></h5>  <!-- Title in black -->
                        <p class="card-text"><?php echo $service_description; ?></p>  <!-- Full description shown with line-clamp CSS -->
                        <hr>
                        
                        <!-- Price and Delivery Time in one line -->
                        <p class="d-flex justify-content-between">
                            <span><i class="fas fa-dollar-sign"></i> <strong>Price:</strong> $<?php echo $pricing; ?></span>
                            <span><i class="fas fa-clock"></i> <strong>Delivery Time:</strong> <?php echo $delivery_time; ?> hours</span>
                        </p>
                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <!-- Artist Profile Link -->
                                <a href="profile_view.php.?id=<?php echo $row['user_id']; ?>">
                                    <img src="<?php echo $artist_profile_picture; ?>" alt="Artist Picture" class="rounded-circle" style="width: 30px; height: 30px;">
                                </a>
                                <a href="profile_view.php.?id=<?php echo $row['user_id']; ?>" class="text-muted"><?php echo $fullname; ?></a>
                            </div>
                            <small class="text-muted"><?php echo date('F j, Y', strtotime($created_at)); ?></small>
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
                            <img src="html/<?php echo $service_media; ?>" class="img-fluid" alt="Full Service Image">
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>

<!-- CSS for line-clamping the description -->
<style>
.card-text {
    display: -webkit-box;
    -webkit-line-clamp: 2;  /* Set this to 2 for limiting the description to 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-title {
    color: black;  /* Title color set to black */
}
</style>




<section id= "featured-projects" class="blank-section" style="background-color: rgba(211, 211, 211, 0.05);">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Featured Projects</h2>
        <p>Discover projects posted by talented artists from various genres.</p>
    </div><!-- End Section Title -->


    <!-- Projects -->
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        // Fetch all projects and the corresponding artist details from the database
        $stmt = $pdo->prepare("SELECT p.*, CONCAT(a.first_name, ' ', a.last_name) AS fullname, a.profile_picture 
                               FROM `projects` p 
                               LEFT JOIN `artists` a ON p.user_id = a.id 
                               ORDER BY p.created_at DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $project_name = htmlspecialchars($row['project_name']);
            $project_description = htmlspecialchars($row['project_description']);
            $project_media = htmlspecialchars($row['project_media']);
            $created_at = htmlspecialchars($row['created_at']);
            $fullname = htmlspecialchars($row['fullname']);
            $artist_profile_picture = htmlspecialchars($row['profile_picture']);
            if (empty($artist_profile_picture)) {
                $artist_profile_picture = 'html/uploads/artists/default_picture_old.jpg';
            } else {
                $artist_profile_picture = 'html/uploads/artists/' . $artist_profile_picture;
            }
        ?>
            <div class="col mb-4">
                <div class="card h-100" style="font-size: 1rem; border: none;">
                    <div class="position-relative">
                        <img src="html/<?php echo $project_media; ?>" class="card-img-top img-thumbnail" alt="Project Image" style="width: 100%; height: 200px; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#projectModal<?php echo $row['id']; ?>">

                        <!-- Love Icon -->
                        <a href="your_backend_php_script.php?project_id=<?php echo $row['id']; ?>" class="position-absolute top-0 end-0 p-2 love-icon" style="font-size: 1.5rem;" onclick="this.classList.toggle('liked')">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                    <div class="card-body">
    <!-- Wrap the project name in a link to the artist's profile -->
    <h6 class="card-title mb-2">
    <!-- <a href="profile_view.php?id=<?php echo $row['user_id']; ?>" class="text-decoration-none" style="color: black;">
        <?php echo $project_name; ?>
    </a> -->
</h6>

    <!-- <p class="card-text text-truncate"><?php echo $project_description; ?></p> -->
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <!-- Artist Profile Link -->
            <a href="profile_view.php.php?id=<?php echo $row['user_id']; ?>">
                <img src="<?php echo $artist_profile_picture; ?>" alt="Artist Picture" class="rounded-circle" style="width: 30px; height: 30px;">
            </a>
            <a href="profile_view.php?id=<?php echo $row['user_id']; ?>" class="text-muted"><?php echo $fullname; ?></a>
        </div>
        <small class="text-muted"><?php echo date('F j, Y', strtotime($created_at)); ?></small>
    </div>
</div>

                </div>
            </div>
            <!-- Modal for Image Full View -->
            <div class="modal fade" id="projectModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="projectModalLabel"><?php echo $project_name; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="html/<?php echo $project_media; ?>" class="img-fluid" alt="Full Project Image">
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

      <!-- Feature 1: Find Talents -->
      <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
        <div class="feature-box orange">
          <i class="bi bi-person-check"></i>
          <h4>Find Talents</h4>
          <p>Access a wide pool of talented professionals, including freelancers and remote workers, ready to bring your projects to life.</p>
        </div>
      </div><!-- End Feature Box -->

      <!-- Feature 2: Secure Transactions -->
      <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
        <div class="feature-box blue">
          <i class="bi bi-lock"></i>
          <h4>Secure Transactions</h4>
          <p>Enjoy secure payment options with escrow to ensure fair compensation and quality work for both clients and freelancers.</p>
        </div>
      </div><!-- End Feature Box -->

      <!-- Feature 3: Remote Work Opportunities -->
      <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
        <div class="feature-box green">
          <i class="bi bi-briefcase"></i>
          <h4>Remote Work Opportunities</h4>
          <p>Explore remote job listings from companies worldwide, offering flexibility and the chance to work from anywhere.</p>
        </div>
      </div><!-- End Feature Box -->

      <!-- Feature 4: Verified Profiles -->
      <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
        <div class="feature-box red">
          <i class="bi bi-check-circle"></i>
          <h4>Verified Profiles</h4>
          <p>All professionals and companies are verified, ensuring trust and reliability for a seamless experience.</p>
        </div>
      </div><!-- End Feature Box -->

    </div>

  </div>

</section><!-- /Features Cards Section -->



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
        <span class="about-meta">ABOUT US</span>
        <h2 class="about-title">Connecting Professionals, Empowering Work</h2>
        <p class="about-description">We are a new platform designed to bring together top-tier freelancers and remote job seekers with clients looking for expert services. From tech to design, writing to marketing, we offer a wide range of opportunities for professionals to grow their careers from anywhere in the world.</p>

        <div class="row feature-list-wrapper">
          <div class="col-md-6">
            <ul class="feature-list">
              <li><i class="bi bi-check-circle-fill"></i> Access global job opportunities</li>
              <li><i class="bi bi-check-circle-fill"></i> Secure payment options</li>
              <li><i class="bi bi-check-circle-fill"></i> Tailored job recommendations</li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="feature-list">
              <li><i class="bi bi-check-circle-fill"></i> Easy project management tools</li>
              <li><i class="bi bi-check-circle-fill"></i> A community of professionals</li>
              <li><i class="bi bi-check-circle-fill"></i> Flexible working hours</li>
            </ul>
          </div>
        </div>

        
      </div>

      <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
        <div class="image-wrapper">
          <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
            <img src="assets/img/about-5.jpg" alt="Freelancer Workspace" class="img-fluid main-image rounded-4">
            <img src="assets/img/about-2.jpg" alt="Team Collaboration" class="img-fluid small-image rounded-4">
          </div>
          <div class="experience-badge floating">
            <h3>10+ <span>Countries</span></h3>
            <p>Where professionals are growing their careers</p>
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