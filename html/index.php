<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_form.php");
    exit;
}
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

<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets2/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>InterlinkMw</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets2/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets2/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets2/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets2/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets2/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets2/vendor/libs/apex-charts/apex-charts.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets2/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets2/js/config.js"></script>
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

         

    <!-- / Navbar -->
<!-- / Navbar -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- First Banner -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- First Simple and Cool Banner -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0" 
                         style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); 
                                border-radius: 12px; 
                                margin-left: -17px; 
                                margin-right: -17px;">
                        <div class="card-body text-center py-5">
                            <h2 class="fw-bold text-white">"Find Experts, Deliver Excellence"</h2>
                            <p class="text-white mt-4" style="font-size: 18px;">
                                Explore the wealth of knowledge and opportunities available on our platform. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <!-- Second Banner Row -->
<div class="row mb-4">
    <!-- Right Card (now full-width) -->
    <div class="col-12">
        <div class="card" style="background-color:rgb(255, 250, 250);">
            <div class="d-flex align-items-center row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title" style="color: black;" class="mb-3">Welcome Back to Your Management Dashboard</h5>
                        <p class="mb-6" style="color: black;">
                            Ensure that your profile is consistently up to date to maintain a strong presence.<br />
                            Highlight your latest achievements and skills to stand out among others. Keep connected with fresh opportunities and expand your network to foster professional growth!
                        </p>
                        <a href="artist_account.php" class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-pencil-square"></i> Update Profile
                        </a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-6">
                        <img src="../assets2/img/illustrations/man-with-laptop_2.png" height="175" class="scaleX-n1-rtl" alt="View Badge User" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Cards with larger margin for spacing on mobile -->
<div class="row">
    <!-- Card 1: What do I have on board -->
    <div class="col-12 col-md-4 mb-4">
        <div class="card shadow-lg border-light rounded" style="background-color:rgb(241, 248, 255);">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-briefcase-fill text-info" style="font-size: 3rem;"></i>
                </div>
                <div>
                    <h4 class="card-title" style="color: black;">My Services</h4>
                    <p class="card-text" style="color: black;">
                        Showcase the diverse services you offer. Let your audience explore the value you bring with your expertise and offerings.
                    </p>
                    <a href="my_services.php" class="btn btn-sm btn-outline-dark">
                        <i class="bi bi-hand-thumbs-up"></i> My Services
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Manage Your Services -->
    <div class="col-12 col-md-4 mb-4">
        <div class="card shadow-lg border-light rounded" style="background-color:rgb(237, 255, 249);">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-tools text-success" style="font-size: 3rem;"></i>
                </div>
                <div>
                    <h4 class="card-title" style="color: black;">My Projects</h4>
                    <p class="card-text" style="color: black;">
                        Take command of your previous projects, manage them effectively, and share them with your audience to demonstrate your ongoing success.
                    </p>
                    <a href="my_projects.php" class="btn btn-sm btn-outline-dark">
                        <i class="bi bi-gear-fill"></i> My Projects
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Share My Profile -->
    <div class="col-12 col-md-4 mb-4">
        <div class="card shadow-lg border-light rounded" style="background-color:rgb(255, 252, 231);">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-share-fill text-primary" style="font-size: 3rem;"></i>
                </div>
                <div>
                    <h4 class="card-title" style="color: black;">Share My Profile</h4>
                    <p class="card-text" style="color: black;">
                        Expand your reach by sharing your profile. Allow others to view your expertise and connect with you for collaborative opportunities.
                    </p>
                    <button id="shareProfileBtn" class="btn btn-sm btn-outline-dark">
                        <i class="bi bi-share"></i> Share My Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- / Content -->
</div>


    <!-- Modal Structure -->
    <div id="shareModal" class="modal" tabindex="-1" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share My Profile</h5>
                    <button type="button" class="btn-close" id="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Copy the link below to share your profile:</p>
                    <input type="text" id="profileLink" class="form-control" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" id="copyLink" class="btn btn-primary">Copy Link</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle modal and link generation -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const shareButton = document.getElementById("shareProfileBtn");
    const modal = document.getElementById("shareModal");
    const closeModalButton = document.getElementById("closeModal");
    const copyButton = document.getElementById("copyLink");
    const profileLinkInput = document.getElementById("profileLink");

    // Get the user ID from PHP (embed the PHP variable inside the JavaScript)
    const userId = <?php echo $_SESSION['user_id']; ?>; // This should be the logged-in user ID from PHP

    // Event listener for "Share My Profile" button
    shareButton.addEventListener("click", function () {
        const baseUrl = window.location.origin; // Get the current domain
        const shareableLink = `${baseUrl}/interlink/profile_view.php?id=${userId}`;
        profileLinkInput.value = shareableLink; // Set the link in the input field
        modal.style.display = "block"; // Show modal
    });

    // Event listener for closing the modal
    closeModalButton.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Event listener for copying the link
    copyButton.addEventListener("click", function () {
        profileLinkInput.select();
        document.execCommand("copy"); // Copy the text to clipboard
        alert("Profile link copied to clipboard!");
    });
});
</script>

<!-- Chart.js Script to render the graph -->
<script>
    var ctx = document.getElementById('performanceGraph').getContext('2d');
    var performanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'],
            datasets: [{
                label: 'Performance Growth',
                data: [12, 19, 13, 22, 15, 30, 28], // Example data points
                borderColor: '#4caf50',
                backgroundColor: 'rgba(76, 175, 80, 0.2)',
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<style>
  .card-img-top {
    object-fit: cover;
    height: 200px; /* Adjust height as needed */
}

.card-body {
    padding: 1.25rem;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
}

.card-text {
    font-size: 1rem;
    color: #555;
}

.btn-outline-primary {
    color: #007bff;
    border-color: #007bff;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    color: white;
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

    <script src="../assets2/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets2/vendor/libs/popper/popper.js"></script>
    <script src="../assets2/vendor/js/bootstrap.js"></script>
    <script src="../assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets2/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets2/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets2/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets2/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
