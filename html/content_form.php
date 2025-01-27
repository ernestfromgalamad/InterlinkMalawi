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


<!-- Portfolio page content here -->


         
      <!-- / Navbar -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">


    <div class="row">
        <div class="col-md-8">
            <!-- Content Posting Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="posts_dashboard.php">
                                <i class="bx bx-sm bx-arrow-nexts me-1_5"></i> My content
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <!-- Content Posting Form -->
                    <form id="formPostContent" method="POST" action="process_content_post.php" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter a catchy title" required />
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Describe your content in detail..." rows="4" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="design">Design</option>
                                    <option value="writing">Writing</option>
                                    <option value="technology">Technology</option>
                                    <option value="photography">Photography</option>
                                    <option value="videography">Videography</option>
                                    <option value="music">Music</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="business-consulting">Business Consulting</option>
                                    <option value="legal-services">Legal Services</option>
                                    <option value="graphic-design">Graphic Design</option>
                                    <option value="web-development">Web Development</option>
                                    <option value="mobile-app-development">Mobile App Development</option>
                                    <option value="architecture">Architecture</option>
                                    <option value="writing-translation">Writing & Translation</option>
                                    <option value="customer-service">Customer Service</option>
                                    <option value="virtual-assistant">Virtual Assistant</option>
                                    <option value="financial-services">Financial Services</option>
                                    <option value="illustration">Illustration</option>
                                    <option value="video-editing">Video Editing</option>
                                    <option value="photography-editing">Photography Editing</option>
                                    <option value="social-media-management">Social Media Management</option>
                                    <option value="fashion-design">Fashion Design</option>
                                    <option value="event-planning">Event Planning</option>
                                    <option value="product-design">Product Design</option>
                                    <option value="SEO">SEO (Search Engine Optimization)</option>
                                    <option value="copywriting">Copywriting</option>
                                    <option value="transcription">Transcription</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="media" class="form-label">Upload Media</label>
                                <input type="file" class="form-control" id="media" name="media" accept="image/*,video/*,application/pdf" />
                                <small class="form-text text-muted">You can upload images, videos, or PDFs.</small>
                            </div>
                            <div class="col-md-12">
                                <label for="tags" class="form-label">Tags (Optional)</label>
                                <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags separated by commas (e.g., design, photography, branding)" />
                            </div>

                            <!-- Who Can View Section -->
                            <div class="col-md-12">
                                <label for="visibility" class="form-label">Who Can View This Content?</label>
                                <select class="form-select" id="visibility" name="visibility" required>
                                    <option value="public">Public (Anyone can view)</option>
                                    <option value="private">Private (Only you can view)</option>
                                    <option value="followers">Followers (Only your followers can view)</option>
                                    <option value="specific-users">Specific Users (Specify users below)</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="specificUsersSection" style="display:none;">
                                <label for="specificUsers" class="form-label">Specify Users (Comma separated usernames)</label>
                                <input type="text" class="form-control" id="specificUsers" name="specific_users" placeholder="Enter usernames separated by commas" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-3">Post Content</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                    <!-- /Content Posting Form -->
                </div>
            </div>
            <!-- /Content Posting Form -->
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
