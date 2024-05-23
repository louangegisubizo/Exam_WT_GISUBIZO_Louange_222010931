<?php
require_once 'database_connection.php'; // Include your database connection file

// Query to select savings goals from the database
$sql = "SELECT goal_name, target_amount FROM saving_goal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $goalName = $row['goal_name'];
        $targetAmount = $row['target_amount'];
        echo "<tr>
                <td>$goalName</td>
                <td>$targetAmount</td>
            </tr>";
    }
} else {
    // Display a message if no goals are set yet
    echo "<tr><td colspan='2'>No savings goals set yet.</td></tr>";
}

// Close database connection
$conn->close();
?>
