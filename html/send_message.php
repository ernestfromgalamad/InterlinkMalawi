<?php
include 'db.php';

// Ensure the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    session_start();  // Make sure the session is started
    $sender_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;  // Fetch sender ID from session
    $receiver_id = isset($_POST['receiver_id']) ? intval($_POST['receiver_id']) : 0;
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Validate inputs
    if (empty($message) || $receiver_id === 0 || $sender_id === 0) {
        die('Invalid message or receiver.');
    }

    // Insert the message into the database
    try {
        $insertMessageQuery = "INSERT INTO messages (sender_id, receiver_id, message, timestamp) 
                               VALUES (:sender_id, :receiver_id, :message, NOW())";
        $stmt = $pdo->prepare($insertMessageQuery);
        $stmt->execute([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message
        ]);

        // Redirect back to the messaging page
        header("Location: message.php?user_id=" . $receiver_id);
        exit;

    } catch (PDOException $e) {
        die("Error saving message: " . $e->getMessage());
    }
} else {
    die('Invalid request method.');
}
?>
