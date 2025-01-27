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

    <title>Demo : Dashboard - Analytics | sneat - Bootstrap Dashboard PRO</title>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


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

         

     <!-- / Navbar -->
<!-- / Navbar -->

<?php
// Include the database connection
include 'db.php';  // Ensure this path is correct relative to your current file
?>

<!-- / Navbar -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
    <div class="col-12 mb-4">
        <div class="hero-card shadow-lg rounded" 
             style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 20px;">
            <div class="card-body text-center py-5">
                <h1 class="fw-bold text-white display-4" style="font-size: 3rem; max-width: 100%; margin: 0 auto;">
                    "Find Experts, Deliver Excellence"
                </h1>
                <p class="text-white mt-3" style="font-size: 20px; max-width: 100%; margin: auto; padding: 0 10px;">
                    Explore a wealth of knowledge and opportunities. Connect with leading experts to ensure your skills stay competitive in an ever-evolving landscape.
                </p>
            </div>
        </div>
    </div>
</div>


        <div class="row">
            <!-- Welcome Message and Steps -->
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Explore Services and Projects 🎨</h4>
                        <p class="card-text">
                            Discover creative services and projects posted by talented artists from various genres.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
    <!-- Services -->
    <?php
// Fetch all services and the corresponding artist profile images from the database
$stmt = $pdo->prepare("SELECT s.*, a.profile_picture FROM `services` s 
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
        $artist_profile_picture = 'uploads/artists/default_picture_old.jpg';
    } else {
        $artist_profile_picture = 'uploads/artists/' . $artist_profile_picture;
    }
?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card shadow-sm h-100" style="font-size: 0.85rem;">
            <div class="position-relative">
                <img src="<?php echo $service_media; ?>" class="card-img-top img-thumbnail" alt="Service Image" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $row['service_id']; ?>">
                <!-- Love Icon -->
                <a href="your_backend_php_script.php?service_id=<?php echo $row['service_id']; ?>" class="position-absolute top-0 end-0 p-2 text-dark" style="font-size: 1.5rem;">
                    <i class="fas fa-heart"></i>
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-title text-primary mb-2"><?php echo $service_name; ?></h6>
                <p class="card-text text-truncate"><?php echo $service_description; ?></p>
                <p><strong>Price:</strong> $<?php echo $pricing; ?></p>
                <p><strong>Delivery Time:</strong> <?php echo $delivery_time; ?> hours</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <img src="<?php echo $artist_profile_picture; ?>" alt="Artist Picture" class="rounded-circle" style="width: 25px; height: 25px;">
                        <small class="text-muted"><?php echo $fullname; ?></small>
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
                    <img src="<?php echo $service_media; ?>" class="img-fluid" alt="Full Service Image">
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Projects -->
<?php
$stmt = $pdo->prepare("SELECT p.*, a.profile_picture FROM `projects` p
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
        $artist_profile_picture = 'uploads/artists/default_picture_old.jpg';
    } else {
        $artist_profile_picture = 'uploads/artists/' . $artist_profile_picture;
    }
?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card shadow-sm h-100" style="font-size: 0.85rem;">
            <div class="position-relative">
                <img src="<?php echo $project_media; ?>" class="card-img-top img-thumbnail" alt="Project Image" data-bs-toggle="modal" data-bs-target="#projectModal<?php echo $row['id']; ?>">
                <!-- Love Icon -->
                <a href="your_backend_php_script.php?project_id=<?php echo $row['id']; ?>" class="position-absolute top-0 end-0 p-2 text-dark" style="font-size: 1.5rem;">
                    <i class="fas fa-heart"></i>
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-title text-primary mb-2"><?php echo $project_name; ?></h6>
                <p class="card-text text-truncate"><?php echo $project_description; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <img src="<?php echo $artist_profile_picture; ?>" alt="Artist Picture" class="rounded-circle" style="width: 25px; height: 25px;">
                        <small class="text-muted"><?php echo $fullname; ?></small>
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
                    <img src="<?php echo $project_media; ?>" class="img-fluid" alt="Full Project Image">
                </div>
            </div>
        </div>
    </div>
<?php } ?>




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
