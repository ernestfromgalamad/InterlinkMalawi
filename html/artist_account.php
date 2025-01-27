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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<!-- Cropper.js CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>



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
                  $address = sanitize($artist['address']);
                  $country = sanitize($artist['country']);
                  $profile_picture = sanitize($artist['profile_picture']);
                  $main_profession = sanitize($artist['main_profession']);
                  $other_professions = sanitize($artist['other_professions']);
                  $skills = explode(',', sanitize($artist['skills']));
                  $facebook = sanitize($artist['facebook']);
                  $instagram = sanitize($artist['instagram']);
                  $twitter = sanitize($artist['twitter']);
                  $whatsapp = sanitize($artist['whatsapp']);
                  $linkedin = sanitize($artist['linkedin']);
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
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Account Settings Form -->
                        <form id="formAccountSettings" method="POST" action="process_artist_details.php" enctype="multipart/form-data">
                            <div class="row g-3">

                                <!-- Cropper.js CSS -->
                                <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">

                                <div class="col-md-12 mt-3">
                                    <label for="profilePicture" class="form-label">Profile Picture</label>
                                    <div class="custom-file-input">
                                        <input type="file" id="profilePicture" name="profilePicture" class="form-control" accept="image/*" />
                                        <div id="imagePreview" class="mt-3"></div>
                                    </div>
                                    <small class="form-text text-muted">Leave blank to keep the current picture.</small>
                                </div>

                                <!-- Crop and Confirm Button -->
                                <div class="mt-3">
                                    <button id="confirmCrop" class="btn btn-primary" disabled>Confirm Crop</button>
                                </div>

                                <!-- Hidden Input for Cropped Image (Base64) -->
                                <input type="hidden" id="croppedImageData" name="croppedImageData">

                                <!-- Add Cropper.js JS -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

                                <!-- JavaScript for Image Preview and Cropping -->
                                <script>
                                    let cropper;

                                    document.getElementById('profilePicture').addEventListener('change', function (event) {
                                        const fileInput = event.target;
                                        const imagePreview = document.getElementById('imagePreview');
                                        const confirmCropButton = document.getElementById('confirmCrop');

                                        // Clear any existing preview and cropper
                                        imagePreview.innerHTML = '';
                                        if (cropper) {
                                            cropper.destroy();
                                        }

                                        if (fileInput.files && fileInput.files[0]) {
                                            const file = fileInput.files[0];

                                            // Validate the file type
                                            if (file.type.startsWith('image/')) {
                                                const reader = new FileReader();

                                                // Load the image and display it in the preview div
                                                reader.onload = function (e) {
                                                    const img = document.createElement('img');
                                                    img.src = e.target.result;
                                                    img.alt = 'Selected Profile Picture';
                                                    img.style.maxWidth = '100%';
                                                    img.style.maxHeight = '400px'; 
                                                    img.id = 'imageToCrop';

                                                    // Append image to preview div
                                                    imagePreview.appendChild(img);

                                                    // Initialize the cropper
                                                    cropper = new Cropper(img, {
                                                        aspectRatio: 1,
                                                        viewMode: 2,
                                                        minCropBoxWidth: 100,
                                                        minCropBoxHeight: 100,
                                                        crop: function () {
                                                            confirmCropButton.disabled = false;
                                                        }
                                                    });
                                                };

                                                reader.readAsDataURL(file);
                                            } else {
                                                const errorText = document.createElement('p');
                                                errorText.textContent = 'Please select a valid image file.';
                                                errorText.style.color = 'red';
                                                imagePreview.appendChild(errorText);
                                            }
                                        }
                                    });

                                    document.getElementById('confirmCrop').addEventListener('click', function () {
                                        const canvas = cropper.getCroppedCanvas();
                                        const croppedImage = canvas.toDataURL('image/png');

                                        const croppedImagePreview = document.createElement('img');
                                        croppedImagePreview.src = croppedImage;
                                        croppedImagePreview.alt = 'Cropped Profile Picture';
                                        croppedImagePreview.style.maxWidth = '150px';
                                        croppedImagePreview.style.maxHeight = '150px';
                                        croppedImagePreview.style.borderRadius = '5px';
                                        croppedImagePreview.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.2)';

                                        const imagePreview = document.getElementById('imagePreview');
                                        imagePreview.innerHTML = ''; 
                                        imagePreview.appendChild(croppedImagePreview);

                                        document.getElementById('croppedImageData').value = croppedImage;
                                        document.getElementById('confirmCrop').disabled = true;
                                    });
                                </script>

                             
                                <!-- Other Fields -->
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $first_name; ?>" required autofocus />
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $last_name; ?>" required />
                                </div>

                                   <!-- Main Profession Input -->
                                   <div class="col-md-6">
                                    <label for="mainProfession" class="form-label">Main Profession</label>
                                    <input class="form-control" type="text" id="mainProfession" name="mainProfession" placeholder="Enter your main profession" value="<?php echo isset($main_profession) ? $main_profession : ''; ?>" required />
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
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" id="country" name="country" class="form-control" placeholder="Enter country name" value="<?php echo isset($country) ? $country : ''; ?>">
                                </div>

                                <!-- Social Media Links -->
                                <div class="col-md-6">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="url" class="form-control" id="facebook" name="facebook" placeholder="Facebook URL" value="<?php echo $facebook; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="url" class="form-control" id="instagram" name="instagram" placeholder="Instagram URL" value="<?php echo $instagram; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <input type="url" class="form-control" id="twitter" name="twitter" placeholder="Twitter URL" value="<?php echo $twitter; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="whatsapp" class="form-label">WhatsApp</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp Number" value="<?php echo $whatsapp; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="linkedin" class="form-label">LinkedIn</label>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn URL" value="<?php echo $linkedin; ?>" />
                                </div>

                                <!-- Skills Section -->
                                <!-- <div class="col-md-12">
                                    <label for="skills" class="form-label">Skills</label>
                                    <div class="input-group" id="skills-container">
                                        <input type="text" class="form-control" id="newSkill" placeholder="Add a skill" />
                                        <button type="button" class="btn btn-success" id="addSkillButton">Add Skill</button>
                                    </div>
                                    <ul class="list-group mt-2" id="skills-list">
                                        <?php
                                            if (!empty($skills)) {
                                                foreach ($skills as $skill) {
                                                    echo "<li class='list-group-item'>$skill <button type='button' class='btn btn-danger btn-sm float-end remove-skill'>Remove</button></li>";
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div> -->
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-3">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Account Settings -->
            </div>
        </div>
    </div>
</div>


<script>
// JavaScript to handle dynamic skill addition and removal
document.getElementById('addSkillButton').addEventListener('click', function() {
    const skillInput = document.getElementById('newSkill');
    const skill = skillInput.value.trim();

    if (skill !== '') {
        // Add skill to list
        const skillsList = document.getElementById('skills-list');
        const newSkillItem = document.createElement('li');
        newSkillItem.classList.add('list-group-item');
        newSkillItem.textContent = skill;

        const removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'float-end', 'remove-skill');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function() {
            skillsList.removeChild(newSkillItem);
        });

        newSkillItem.appendChild(removeButton);
        skillsList.appendChild(newSkillItem);

        // Clear the input
        skillInput.value = '';
    }
});
</script>

<script>
// JavaScript to handle dynamic skill addition and removal
document.getElementById('addSkillButton').addEventListener('click', function() {
    const skillInput = document.getElementById('newSkill');
    const skill = skillInput.value.trim();

    if (skill !== '') {
        // Add skill to list
        const skillsList = document.getElementById('skills-list');
        const newSkillItem = document.createElement('li');
        newSkillItem.classList.add('list-group-item');
        newSkillItem.textContent = skill;

        const removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'float-end', 'remove-skill');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function() {
            skillsList.removeChild(newSkillItem);
        });

        newSkillItem.appendChild(removeButton);
        skillsList.appendChild(newSkillItem);

        // Clear the input
        skillInput.value = '';
    }
});
</script>


<!-- Bootstrap JavaScript (for Modal functionality) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- Optional: Add any additional JavaScript -->

<style>

    /* Custom styling for file input */
.custom-file-input {
    position: relative;
    overflow: hidden;
    border: 2px dashed #ced4da;
    background-color: #f8f9fa;
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.custom-file-input:hover {
    border-color: #007bff;
    background-color: #e9ecef;
}

.custom-file-input input[type="file"] {
    position: absolute;
    opacity: 0;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    cursor: pointer;
}

.custom-file-label {
    font-size: 14px;
    color: #6c757d;
    text-align: center;
}

.custom-file-input small {
    display: block;
    margin-top: 5px;
    color: #6c757d;
}



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
