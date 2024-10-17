<?php
session_start();
require 'config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Set session
            header("Location: dashboard.html"); // Redirect to dashboard
            exit();
        } else {
            echo "<p>Incorrect password. Try again.</p>";
        }
    } else {
        echo "<p>Email not registered. Sign up first.</p>";
    }
}
?>
