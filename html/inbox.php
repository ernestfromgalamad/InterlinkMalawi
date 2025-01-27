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

<?php
// Include database connection
include 'db.php';

// Fetch all users from the `artists` table
try {
    $query = "SELECT id, first_name, last_name, email, profile_picture FROM artists";
    $stmt = $pdo->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Failed to retrieve users: " . $e->getMessage());
}
?>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- First Banner -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0"
                         style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
                                border-radius: 12px; margin-left: -17px; margin-right: -17px;">
                        <div class="card-body text-center py-5">
                            <h2 class="fw-bold text-white">"Find Experts, Deliver Excellence"</h2>
                            <p class="text-white mt-4" style="font-size: 18px;">
                                Explore the wealth of knowledge and opportunities available on our platform. 
                                Connect with leading experts in the field and ensure that your skills stay competitive in this ever-evolving landscape.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User List Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="color: black;">Message an Artist</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            <div class="card-body text-center">
                                            <img src="uploads/artists/<?php echo htmlspecialchars($user['profile_picture']) ?: 'default-avatar.jpg'; ?>" 
                                            alt="User Avatar" class="rounded-circle me-2" width="40" height="40">
                                                <h5 class="card-title"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h5>
                                                <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                                                <a href="message.php?user_id=<?php echo htmlspecialchars($user['id']); ?>" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    Message
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center">No artists found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->
</div>


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
