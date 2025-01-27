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
         

          <!-- / Navbar -->

         <!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-4 mb-4">
                <!-- Profile Picture and Personal Details -->
                <div class="card">
                    <div class="card-body text-center">
                    <div class="mb-3 d-flex justify-content-center">
                                <?php if (!empty($profile_picture)): ?>
                                    <img src="uploads/artists/<?php echo $profile_picture; ?>" alt="Profile Picture" class="img-thumbnail rounded-circle" width="150">
                                <?php else: ?>
                                    <img src="uploads/artists/default_picture_old.jpg" alt="Default Profile Picture" class="img-thumbnail rounded-circle" width="150">
                                <?php endif; ?>
                            </div>
                        <h5 class="card-title"><?php echo $first_name . ' ' . $last_name; ?></h5>
                        <p class="card-text"><?php echo $email; ?></p>
                      
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Account Settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript:void(0);">
                                    <i class="bx bx-sm bx-user me-1_5"></i> Account
                                </a>
                            </li>
                            <li class="nav-item">
    <a class="nav-link" href="portfolio.php">
        <i class="bx bx-sm bx-briefcase me-1_5"></i> Portfolio
    </a>
</li>

                            <!-- <li class="nav-item">
                                <a class="nav-link" href="pages-account-settings-connections.html">
                                    <i class="bx bx-sm bx-link-alt me-1_5"></i> Connections
                                </a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Account Settings Form -->
                        <form id="formAccountSettings" method="POST" action="process_artist_details.php" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $first_name; ?>" required autofocus />
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $last_name; ?>" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="artist@example.com" value="<?php echo $email; ?>" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="123 456 7890" value="<?php echo $phone_number; ?>" />
                                </div>
                                <div class="col-md-12">
                                    <label for="biography" class="form-label">Biography</label>
                                    <textarea class="form-control" id="biography" name="biography" placeholder="Tell us about yourself..." rows="3"><?php echo $biography; ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="genre" class="form-label">Primary Genre</label>
                                    <input type="text" class="form-control" id="genre" name="genre" placeholder="E.g., Painter, Sculptor, Musician" value="<?php echo $genre; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="portfolio" class="form-label">Portfolio Link</label>
                                    <input type="url" class="form-control" id="portfolio" name="portfolio" placeholder="https://portfolio.com" value="<?php echo $portfolio; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="socialMedia" class="form-label">Social Media Handle</label>
                                    <input type="text" class="form-control" id="socialMedia" name="socialMedia" placeholder="@artistname" value="<?php echo $social_media; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="achievements" class="form-label">Achievements</label>
                                    <textarea class="form-control" id="achievements" name="achievements" placeholder="List your achievements" rows="2"><?php echo $achievements; ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Street Address" value="<?php echo $address; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="country" class="form-label">Country</label>
                                    <select id="country" name="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="United States" <?php if ($country === 'United States') echo 'selected'; ?>>United States</option>
                                        <option value="Canada" <?php if ($country === 'Canada') echo 'selected'; ?>>Canada</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="currency" class="form-label">Preferred Currency</label>
                                    <select id="currency" name="currency" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="usd" <?php if ($currency === 'usd') echo 'selected'; ?>>USD</option>
                                        <option value="euro" <?php if ($currency === 'euro') echo 'selected'; ?>>Euro</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="profilePicture" class="form-label">Profile Picture</label>
                                    <input class="form-control" type="file" id="profilePicture" name="profilePicture" />
                                    <small class="form-text text-muted">Leave blank to keep the current picture.</small>
                                
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-3">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                        <!-- /Account Settings Form -->
                    </div>
                </div>
                <!-- /Account Settings -->
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
