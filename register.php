<?php
require_once 'database_connection.php';
session_start();

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$job = $_POST['job'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate that passwords match
if ($password !== $confirm_password) {
    echo "Error: Passwords do not match.";
    exit();
}

// Check if user already exists
$sql_check = "SELECT * FROM user WHERE username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "Error: User already exists.";
    $stmt_check->close();
    $conn->close();
    exit();
}
$stmt_check->close();

// Begin a transaction
$conn->begin_transaction();

try {
    // Insert data into profile table
    $sql_profile = "INSERT INTO profile (first_name, last_name, email, job) VALUES (?, ?, ?, ?)";
    $stmt_profile = $conn->prepare($sql_profile);
    $stmt_profile->bind_param("ssss", $first_name, $last_name, $email, $job);
    $stmt_profile->execute();

    // Get the last inserted profile ID
    $referenced_id = $stmt_profile->insert_id;

    // Insert data into users table
    $sql_users = "INSERT INTO user (referenced_id, username, password) VALUES (?, ?, ?)";
    $stmt_users = $conn->prepare($sql_users);
    $stmt_users->bind_param("iss", $referenced_id, $username, $password);
    $stmt_users->execute();

    // Commit transaction
    $conn->commit();

    // Set session variables
    $_SESSION['first_name'] = $first_name;
    $_SESSION['referenced_id'] = $referenced_id;

    // Redirect to a welcome or home page
    header("Location: login.html");
    exit();
} catch (Exception $e) {
    // Rollback transaction in case of error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close statements and connection
$stmt_profile->close();
$stmt_user->close();
$conn->close();
?>
