<?php
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Prevent the browser from caching the page (to avoid accessing the page via back button)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Redirect to login page after logout
header("Location: login_form.php");
exit;
?>
