<?php
include 'db.php';

function generateToken() {
    return bin2hex(random_bytes(32)); // Secure 64-character hash
}

$user_id = $_SESSION['user_id']; // Logged-in user's ID
$token = generateToken();
$expires_at = date('Y-m-d H:i:s', strtotime('+7 days')); // Optional: Link expires in 7 days

try {
    // Insert token into profile_sharing table
    $sql = "INSERT INTO profile_sharing (user_id, token, expires_at) 
            VALUES (:user_id, :token, :expires_at)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'token' => $token,
        'expires_at' => $expires_at
    ]);

    // Generate secure link
    $baseUrl = "https://yourdomain.com/interlink/profile_view.php";
    $shareableLink = "$baseUrl?token=$token";

    echo json_encode(['link' => $shareableLink]); // Send link as JSON
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
