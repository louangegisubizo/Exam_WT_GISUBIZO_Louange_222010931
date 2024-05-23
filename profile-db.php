<?php
session_start();

// Include the database connection file
include 'database_connection.php';

// Initialize variables
$first_name = "";
$job = "";
$email = "";
$phone_number = "";

// Check if the session variable is set
if(isset($_SESSION['username'])) {
    $Username = $_SESSION['username'];

    // Fetch the lawyer_id associated with the username
    $stmt = $conn->prepare("SELECT referenced_id FROM user WHERE username = ?");
    $stmt->bind_param("s", $Username);
    $stmt->execute();
    $stmt->bind_result($referenced_id);
    $stmt->fetch();
    $stmt->close();

    // Fetch the lawyer's profile information from the lawyers table using lawyer_id
    $stmt = $conn->prepare("SELECT * FROM profile WHERE owner_id = ?");
    $stmt->bind_param("i", $referenced_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // Check if data is fetched
    if ($row) {
        // Assign fetched data to variables
        $first_name = $row['first_name'];
        $job = $row['job'];
        $email = $row['email'];
        $phone_number = $row['phone'];
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get edited phone number from POST request
        $phone = $_POST['phone'];

        // Update the phone number in the lawyers table
        $stmt = $conn->prepare("UPDATE profile SET phone = ? WHERE owner_id = ?");
        $stmt->bind_param("si", $phone, $referenced_id);
        $stmt->execute();
        $stmt->close();

        // Redirect to profile page after updating
        header("Location: profile.php");
        exit();
    }
} else {
    // Redirect to login page if session variable not set
    echo "<script>alert('no session variable')</script>";
}
?>
