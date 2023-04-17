<?php
session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Get username if user is logged in
if ($isLoggedIn) {
  $email = $_SESSION['user_id'];
  $users = array_map('str_getcsv', file('users.csv'));
  foreach ($users as $user) {
    if (isset($user[1]) && $user[1] === $email) {
      $username = $user[0];
      break;
    }
  }
}

// Return response as JSON
$response = array(
  'isLoggedIn' => $isLoggedIn,
  'username' => isset($username) ? $username : null
);

if (isset($_POST['logout'])) {
  // Unset all session variables
  $_SESSION = array();
  
  // Destroy the session
  session_destroy();
  
  // Redirect the user to the login page
  header('Location: login.php');
  exit;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
