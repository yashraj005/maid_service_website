<?php
session_start();
require 'config.php'; // Include the database connection

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
            // Set session for email
            $_SESSION['userEmail'] = $user['email']; // Store email in session

            // Redirect to dashboard.html
            header("Location: dashboard.html");
            exit(); // Ensure the script ends after redirection
        } else {
            echo "<p>Incorrect password. Try again.</p>";
        }
    } else {
        echo "<p>Email not registered. Sign up first.</p>";
    }
}
?>
