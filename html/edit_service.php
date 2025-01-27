<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_form.php");
    exit;
}

// Check if the id is set and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $service_id = $_GET['id'];

    // Include the database connection
    include 'db.php';

    try {
        // Prepare the SQL statement to fetch service details based on service_id
        $stmt = $pdo->prepare("SELECT * FROM services WHERE service_id = :service_id");
        $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if the service exists
        if ($stmt->rowCount() > 0) {
            // Fetch the service details
            $service = $stmt->fetch(PDO::FETCH_ASSOC);

            // Assign values to variables to pre-fill the form
            $service_name = $service['service_name'];
            $service_description = $service['service_description'];
            $service_type = $service['service_type'];
            $pricing = $service['pricing'];
            $delivery_time = $service['delivery_time'];
            $service_media = $service['service_media'];
            $tags = $service['tags'];
        } else {
            // Service not found, show error message
            echo "Service not found.";
            exit;
        }
    } catch (PDOException $e) {
        die("Error fetching service details: " . $e->getMessage());
    }
} else {
    // Redirect if id is not provided or invalid
    echo "Invalid Service ID.";
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


<!-- Portfolio page content here -->


         
      <!-- / Navbar -->
<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-md-8">
                <!-- Edit Digital Service Form -->
                <div class="card mb-4">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="my_services.php">
                                    <i class="bx bx-sm bx-arrow-nexts me-1_5"></i> My Services
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Edit Digital Service Form -->
                        <form id="formEditService" method="POST" action="process_service_edit.php" enctype="multipart/form-data">
                            <input type="hidden" name="service_id" value="<?php echo $service_id; ?>" />
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="serviceName" class="form-label">Service Name</label>
                                    <input type="text" class="form-control" id="serviceName" name="service_name" placeholder="Enter the service name" value="<?php echo htmlspecialchars($service_name); ?>" required />
                                </div>
                                <div class="col-md-12">
                                    <label for="serviceDescription" class="form-label">Service Description</label>
                                    <textarea class="form-control" id="serviceDescription" name="service_description" placeholder="Describe your service in detail..." rows="4" required><?php echo htmlspecialchars($service_description); ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="serviceType" class="form-label">Service Type</label>
                                    <select class="form-select" id="serviceType" name="service_type" required>
                                        <option value="design" <?php echo $service_type == 'design' ? 'selected' : ''; ?>>Design</option>
                                        <option value="writing" <?php echo $service_type == 'writing' ? 'selected' : ''; ?>>Writing</option>
                                        <option value="technology" <?php echo $service_type == 'technology' ? 'selected' : ''; ?>>Technology</option>
                                        <option value="marketing" <?php echo $service_type == 'marketing' ? 'selected' : ''; ?>>Marketing</option>
                                        <option value="consulting" <?php echo $service_type == 'consulting' ? 'selected' : ''; ?>>Consulting</option>
                                        <option value="development" <?php echo $service_type == 'development' ? 'selected' : ''; ?>>Development</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="pricing" class="form-label">Pricing ($)</label>
                                    <input type="number" class="form-control" id="pricing" name="pricing" placeholder="Enter the price" value="<?php echo htmlspecialchars($pricing); ?>" min="0" step="0.01" required />
                                </div>
                                <div class="col-md-12">
                                    <label for="deliveryTime" class="form-label">Delivery Time (Days)</label>
                                    <input type="number" class="form-control" id="deliveryTime" name="delivery_time" placeholder="Enter delivery time in days" value="<?php echo htmlspecialchars($delivery_time); ?>" min="1" required />
                                </div>
                                <div class="col-md-12">
                                    <label for="serviceMedia" class="form-label">Upload Media (Leave empty to keep existing)</label>
                                    <input type="file" class="form-control" id="serviceMedia" name="service_media" accept="image/*,video/*,application/pdf" />
                                    <small class="form-text text-muted">You can upload images, videos, or PDFs related to your service. Leave empty to keep existing media.</small>
                                </div>
                                <div class="col-md-12">
                                    <label for="tags" class="form-label">Tags (Optional)</label>
                                    <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags separated by commas (e.g., design, branding, SEO)" value="<?php echo htmlspecialchars($tags); ?>" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-3">Save Changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                        <!-- /Edit Digital Service Form -->
                    </div>
                </div>
                <!-- /Edit Digital Service Form -->
            </div>
        </div>
    </div>
</div>

<script>
// Show/hide "Specific Users" field based on visibility selection
document.getElementById('visibility').addEventListener('change', function() {
    if (this.value === 'specific-users') {
        document.getElementById('specificUsersSection').style.display = 'block';
    } else {
        document.getElementById('specificUsersSection').style.display = 'none';
    }
});
</script>


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
