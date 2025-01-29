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
  data-assets-path="../assets2/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Intelink-User_dashboard</title>

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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


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
          <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Welcome Message and Steps -->
            <div class="col-12 mb-4">
    <div class="card shadow-sm border-0"
         style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
                border-radius: 12px;">
       <div class="card-body">
    <h4 class="card-title text-white">
    YOUR PROJECTS
    </h4>
    <p class="card-text text-white" style="font-size: 18px;">
        Take command of your previous projects, manage them effectively, and share them with your audience to demonstrate your ongoing success.
    </p>
    <a href="add_projects_form.php" class="btn btn-light btn-lg shadow-sm">
        <i class="fas fa-plus-square"></i>  Create New Project
    </a>
</div>

    </div>
</div>

        </div>

        <div class="row">
            <?php
            // Assuming $_SESSION['user_id'] contains the logged-in user's ID
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                // Prepare and execute the query to fetch only projects for the logged-in user
                $stmt = $pdo->prepare("SELECT * FROM `projects` WHERE `user_id` = :user_id ORDER BY `created_at` DESC");
                $stmt->execute(['user_id' => $user_id]);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $project_name = htmlspecialchars($row['project_name']);
                    $project_description = htmlspecialchars($row['project_description']);
                    $project_media = htmlspecialchars($row['project_media']);
                    $created_at = htmlspecialchars($row['created_at']);
                    $tags = htmlspecialchars($row['tags']);
            ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <!-- Image Thumbnail -->
                            <img src="<?php echo $project_media; ?>" class="card-img-top img-thumbnail" alt="Project Image" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $row['id']; ?>">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?php echo $project_name; ?></h5>
                                <p class="card-text"><?php echo $project_description; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Created on: <?php echo date('F j, Y', strtotime($created_at)); ?></small>
                                    <!-- Edit and Delete Buttons -->
                                    <div>
                                        <a href="edit_project.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Image Full View -->
                    <div class="modal fade" id="imageModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel"><?php echo $project_name; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="<?php echo $project_media; ?>" class="img-fluid" alt="Full Project Image">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this project?</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="delete_project.php">
                                        <input type="hidden" name="project_id" value="<?php echo $row['id']; ?>">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php } } else { ?>
                <p>You must be logged in to view your projects.</p>
            <?php } ?>
        </div>
    </div>
    <!-- / Content -->
</div>


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
