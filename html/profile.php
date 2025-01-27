<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_form.php");
    exit;
}
?>

<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo : Dashboard - Analytics | sneat - Bootstrap Dashboard PRO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>


  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->


        <?php include 'header.php'; ?>



        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php include 'navbar.php'; ?>

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


<!-- Bootstrap JavaScript (for Modal functionality) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- Optional: Add any additional JavaScript -->

<style>





/* Success Message in Black */
.custom-modal .alert-success {
    color: #000; /* Black text */
    background-color: #e7f4e7; /* Light green background */
    border-color: #c3e6cb; /* Light green border */
}

/* Smaller and Stylish Modal */
.custom-modal {
    width: 400px;
    border-radius: 8px;
    background-color: #f9f9f9;
    color: #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border: none;
}

.custom-modal .modal-header {
    background-color: #007bff; /* Soft blue header */
    color: #fff;
    border-radius: 8px 8px 0 0;
    padding: 1rem;
}

.custom-modal .modal-body {
    padding: 1rem;
    font-size: 1rem;
    line-height: 1.5;
}

.custom-modal .modal-footer {
    padding: 1rem;
    background-color: #f5f5f5;
    border-radius: 0 0 8px 8px;
}

.custom-modal .modal-title {
    font-size: 1.2rem;
    font-weight: 600;
}

.custom-modal .btn-close {
    background-color: transparent;
    border: none;
    color: #fff;
    font-size: 1.25rem;
    opacity: 0.8;
}

.custom-modal .btn-close:hover {
    opacity: 1;
}

.custom-modal .btn-outline-secondary {
    background-color: #e0e0e0;
    color: #333;
    border: 1px solid #ccc;
    font-weight: 500;
    transition: all 0.3s ease;
}

.custom-modal .btn-outline-secondary:hover {
    background-color: #d0d0d0;
    border-color: #bbb;
}

.custom-btn {
    background-color: #007bff; /* Soft blue for the button */
    color: #fff;
    border-radius: 6px;
    padding: 8px 18px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.custom-btn:hover {
    background-color: #0056b3; /* Darker blue on hover */
    border-color: #0056b3;
}

.custom-btn:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}

</style>



            <?php include 'footer.php'; ?>

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

 

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
