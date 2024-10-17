<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userEmail'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

// Return the session data as JSON
echo json_encode(['email' => $_SESSION['userEmail']]);
?>
