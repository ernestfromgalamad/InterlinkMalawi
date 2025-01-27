<?php
include 'db_connect.php'; // Database connection file
if (isset($_GET['id'])) {
    $artist_id = intval($_GET['id']);
    $query = "SELECT * FROM artists WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $artist_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $artist = $result->fetch_assoc();
    if (!$artist) {
        echo "Artist not found!";
        exit;
    }
} else {
    echo "Invalid artist profile!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($artist['first_name'] . ' ' . $artist['last_name']); ?>'s Profile</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($artist['first_name'] . ' ' . $artist['last_name']); ?></h1>
    <p><strong>Genre:</strong> <?php echo htmlspecialchars($artist['genre']); ?></p>
    <p><strong>Biography:</strong> <?php echo nl2br(htmlspecialchars($artist['biography'])); ?></p>
    <p><strong>Achievements:</strong> <?php echo nl2br(htmlspecialchars($artist['achievements'])); ?></p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($artist['email']); ?></p>
    <!-- Add more fields as needed -->
    <img src="<?php echo htmlspecialchars($artist['profile_picture']); ?>" alt="Profile Picture" width="150">
</body>
</html>
