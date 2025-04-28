<?php
session_start();
require "includes/database_connect.php";

// If user not logged in, redirect to login modal on homepage
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php#loginModal");
    exit;
}

$property_id = intval($_GET['property_id']);
$user_id = intval($_SESSION['user_id']);

// Check if user_id exists
$user_check_stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
$user_check_stmt->bind_param("i", $user_id);
$user_check_stmt->execute();
$user_check_result = $user_check_stmt->get_result();

if ($user_check_result->num_rows == 0) {
    // User not found, clear session and redirect
    session_destroy();
    header("Location: index.php#loginModal");
    exit;
}

// Insert booking
$insert_stmt = $conn->prepare(
    "INSERT INTO bookings (property_id, user_id, status) VALUES (?, ?, 'confirmed')"
);
$insert_stmt->bind_param("ii", $property_id, $user_id);

if ($insert_stmt->execute()) {
    // Booking successful, go back to property details page
    header("Location: property_detail.php?property_id=$property_id&booking=success");
    exit;
} else {
    echo "Failed to book. Please try again later.";
}

?>
