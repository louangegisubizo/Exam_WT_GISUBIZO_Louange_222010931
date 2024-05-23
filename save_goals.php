<?php
require_once 'database_connection.php'; // Include your database connection file

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set and not empty
    if (isset($_POST['goal_name']) && isset($_POST['target_amount']) && !empty($_POST['goal_name']) && !empty($_POST['target_amount'])) {
        // Sanitize and store form data
        $goalName = htmlspecialchars($_POST['goal_name']);
        $targetAmount = $_POST['target_amount'];

        // Prepare and bind parameters
        $stmt = $conn->prepare("INSERT INTO saving_goal (goal_name, target_amount) VALUES (?, ?)");
        $stmt->bind_param("ss", $goalName, $targetAmount);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the page after saving the goal
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            // Handle database insertion error
            echo "Error: " . $conn->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        // Handle form validation errors
        echo "Please fill in all fields.";
    }
}
?>
