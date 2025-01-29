<?php
// Start the session


// Include database connection
include 'db.php';

// Default values
$profile_picture = 'uploads/artists/default_picture_old.jpg'; // Default image if no profile picture is found
$artist_name = "Unknown Artist";
$artist_email = "unknown@example.com";

// Check if user ID is set in the session
if (isset($_SESSION['user_id'])) {
    $artist_id = $_SESSION['user_id']; // Assuming user_id is stored in session

    try {
        // Fetch artist details
        $sql = "SELECT profile_picture, CONCAT(first_name, ' ', last_name) AS artist_name, email 
                FROM artists 
                WHERE id = :artist_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
        $stmt->execute();
        $artist = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values if the artist exists
        if ($artist) {
            $artist_name = $artist['artist_name'];
            $artist_email = $artist['email'];
            if (!empty($artist['profile_picture'])) {
                $profile_picture = 'uploads/artists/' . $artist['profile_picture'];
            }
        }
    } catch (PDOException $e) {
        // Handle query error (optional logging or debugging)
        error_log("Error fetching artist details: " . $e->getMessage());
    }
}
?>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="bx bx-menu bx-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
<div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
        <input type="text" id="searchInput" class="form-control border-0 shadow-none ps-1 ps-sm-2"  />
    </div>
</div>
<!-- /Search -->


        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="<?php echo $profile_picture; ?>" alt="User Profile" class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="<?php echo $profile_picture; ?>" alt="User Profile" class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0"><?php echo htmlspecialchars($artist_name); ?></h6>
                                    <small class="text-muted"><?php echo htmlspecialchars($artist_email); ?></small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="artist_account.php">
                            <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="logout.php">
                            <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- /User -->

            <!-- Notification Bell -->
            <!-- <li class="nav-item">
                <a href="javascript:void(0);" class="nav-link">
                    <i class="bx bx-bell bx-md"></i> 
                </a>
            </li> -->
            <!-- /Notification Bell -->
        </ul>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const sentences = [
        "Looking for something?",
        "Find what you need!",
        "Search for your favorite items.",
        "Explore our latest products.",
        "Type to search...",
    ];

    let sentenceIndex = 0;
    let charIndex = 0;
    const searchInput = document.getElementById("searchInput");
    const typingSpeed = 100; // Typing speed in milliseconds
    const eraseSpeed = 50;  // Erasing speed in milliseconds
    const pauseDuration = 1000; // Duration to pause before typing the next sentence

    function typeSentence() {
        const currentSentence = sentences[sentenceIndex];
        if (charIndex < currentSentence.length) {
            searchInput.value += currentSentence.charAt(charIndex);
            charIndex++;
            setTimeout(typeSentence, typingSpeed);
        } else {
            setTimeout(eraseSentence, pauseDuration);
        }
    }

    function eraseSentence() {
        const currentSentence = sentences[sentenceIndex];
        if (charIndex > 0) {
            searchInput.value = currentSentence.substring(0, charIndex - 1);
            charIndex--;
            setTimeout(eraseSentence, eraseSpeed);
        } else {
            sentenceIndex = (sentenceIndex + 1) % sentences.length;
            setTimeout(typeSentence, pauseDuration);
        }
    }

    // Start the typing effect
    typeSentence();
});

</script>
