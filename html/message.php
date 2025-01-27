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
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

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


<!-- Portfolio page content here -->


<?php
include 'db.php';

// Fetch all artists (contacts) for the dropdown lineup of profile pictures
try {
    $contactsQuery = "SELECT id, profile_picture, first_name, last_name FROM artists";
    $stmt = $pdo->prepare($contactsQuery);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching contacts: " . $e->getMessage());
}

// Assuming you're storing the logged-in user's ID in the session
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$my_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

if ($my_id === 0) {
    die("You must be logged in to chat.");
}

// Fetch user details
try {
    $userQuery = "SELECT first_name, last_name, profile_picture FROM artists WHERE id = :id";
    $stmt = $pdo->prepare($userQuery);
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found.");
    }
} catch (PDOException $e) {
    die("Error fetching user details: " . $e->getMessage());
}

// Fetch chat messages
try {
    $messageQuery = "SELECT sender_id, receiver_id, message, timestamp FROM messages 
                     WHERE (sender_id = :user_id AND receiver_id = :my_id)
                     OR (sender_id = :my_id AND receiver_id = :user_id)
                     ORDER BY timestamp ASC";
    $stmt = $pdo->prepare($messageQuery);
    $stmt->execute([ 'user_id' => $user_id, 'my_id' => $my_id ]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching messages: " . $e->getMessage());
}
?>

<!-- Messaging Panel UI -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column">

        <!-- Dropdown Button to Toggle Contacts List with Down Icon -->
        <button class="btn btn-outline-secondary mb-3 d-flex align-items-center" id="toggleContactsBtn">
            Contacts
            <i id="toggleIcon" class="fas fa-chevron-down ms-2"></i>
        </button>

        <!-- Dropdown Menu for Contacts -->
        <div class="contacts-dropdown-menu p-3 mb-3 bg-light" id="contactsDropdown" style="display: none;">
            <div class="d-flex flex-wrap">
                <?php foreach ($contacts as $contact): ?>
                    <div class="contact-item me-3 mb-2">
                        <a href="message.php?user_id=<?php echo $contact['id']; ?>">
                            <img src="uploads/artists/<?php echo htmlspecialchars($contact['profile_picture']) ?: 'default-avatar.jpg'; ?>"
                                 alt="<?php echo htmlspecialchars($contact['first_name'] . ' ' . $contact['last_name']); ?>"
                                 class="rounded-circle" width="40" height="40">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Chat Header -->
        <div class="chat-header d-flex justify-content-between align-items-center p-3 bg-light border-bottom">
            <div class="chat-user d-flex align-items-center">
                <img src="uploads/artists/<?php echo htmlspecialchars($user['profile_picture']) ?: 'default-avatar.jpg'; ?>" 
                     alt="User Avatar" class="rounded-circle me-2" width="40" height="40">
                <span class="fw-bold"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></span>
            </div>
            <button class="btn btn-sm btn-outline-secondary">Options</button>
        </div>

        <!-- Chat Messages -->
        <div class="chat-messages flex-grow-1 p-3 overflow-auto bg-white" id="chatMessages">
            <?php foreach ($messages as $message): ?>
                <?php 
                    // Fetch sender details
                    $senderQuery = "SELECT first_name, last_name, profile_picture FROM artists WHERE id = :sender_id";
                    $stmtSender = $pdo->prepare($senderQuery);
                    $stmtSender->execute(['sender_id' => $message['sender_id']]);
                    $sender = $stmtSender->fetch(PDO::FETCH_ASSOC);
                ?>
                
                <!-- Show messages from both the sender and receiver -->
                <div class="message d-flex mb-3 <?php echo ($message['sender_id'] === $my_id) ? 'flex-row-reverse' : ''; ?>">
                    <img src="uploads/artists/<?php echo htmlspecialchars($sender['profile_picture']) ?: 'default-avatar.jpg'; ?>" 
                         alt="Sender Avatar" class="rounded-circle me-2" width="40" height="40">
                    <div class="message-content <?php echo ($message['sender_id'] === $my_id) ? 'message-sent' : 'message-received'; ?> p-3 rounded">
                        <p class="mb-0"><?php echo htmlspecialchars($message['message']); ?></p>
                        <small class="<?php echo ($message['sender_id'] === $my_id) ? 'text-light' : 'text-muted'; ?>">
                            <?php echo htmlspecialchars($message['timestamp']); ?>
                        </small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Chat Input (Always at the bottom) -->
        <div class="chat-input p-3 bg-light border-top">
            <form id="chatForm" method="POST" action="send_message.php" class="d-flex align-items-center">
                <input type="hidden" name="receiver_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <input type="text" name="message" id="chatInput" class="form-control me-2" placeholder="Type a message..." required>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .content-wrapper {
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .contacts-dropdown-menu {
        display: none;
        white-space: nowrap;
        overflow-x: auto;
    }

    .contact-item {
        display: inline-block;
    }

    .contact-item a {
        display: block;
        width: 40px;
        height: 40px;
        text-align: center;
    }

    .chat-messages {
        flex-grow: 1;
        overflow-y: auto;
        padding-bottom: 60px; /* Space for the typing panel */
    }

    .message-content {
        max-width: 70%;
        padding: 15px;
        transition: all 0.3s ease;
        position: relative;
        background-color: transparent; /* No background color */
        border: none; /* No border or outline */
        color: #000; /* Set text color to black */
    }

    .message {
        align-items: flex-start;
    }

    .message-content.message-sent {
        color: #000; /* Sent messages are black */
    }

    .message-content.message-received {
        color: #000; /* Received messages are black */
    }

    .message:hover .message-content {
        transform: scale(1.05);
    }

    /* Ensure the chat input stays at the bottom */
    .chat-input {
        position: sticky;
        bottom: 0;
        z-index: 10;
        background-color: #f9f9f9;
    }

    .fas {
        transition: transform 0.2s;
    }

    .fas.rotate {
        transform: rotate(180deg);
    }
</style>

<!-- JavaScript to Toggle Contacts Dropdown with Icon Rotation -->
<script>
    document.getElementById('toggleContactsBtn').addEventListener('click', function() {
        const dropdownMenu = document.getElementById('contactsDropdown');
        const toggleIcon = document.getElementById('toggleIcon');
        
        // Toggle visibility of the contacts dropdown menu
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
        
        // Rotate the icon when dropdown is open
        toggleIcon.classList.toggle('rotate');
    });

    const chatMessages = document.getElementById('chatMessages');
    chatMessages.scrollTop = chatMessages.scrollHeight;

    // For new messages, scroll to bottom after message submission.
    document.getElementById('chatForm').addEventListener('submit', function() {
        setTimeout(function() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 50); // Small delay to ensure message is added
    });
</script>


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
