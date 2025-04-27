<?php
session_start();
require "includes/database_connect.php";

// if user not logged in redirect to login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$property_id = intval($_GET['property_id']);
$user_id     = $_SESSION['user_id'];

// insert booking
$stmt = $conn->prepare(
  "INSERT INTO bookings (property_id,user_id,status) VALUES (?,?, 'confirmed')"
);
$stmt->bind_param("ii", $property_id, $user_id);

if ($stmt->execute()) {
  // back to detail page
  header("Location: property_detail.php?property_id=$property_id");
  exit;
} else {
  echo "Failed to book. Please try again.";
}
