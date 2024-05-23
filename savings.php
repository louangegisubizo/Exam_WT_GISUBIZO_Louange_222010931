<?php
require_once 'database_connection.php'; // Include your database connection file

// Query to select savings goals from the database
$sql = "SELECT goal_name, target_amount FROM saving_goal";
$result = $conn->query($sql);
$savingsGoals = [];

if ($result->num_rows > 0) {
    // Fetching the savings goals data
    while ($row = $result->fetch_assoc()) {
        $savingsGoals[] = $row;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savings Goals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Savings Goals</h1>

        <form id="savingsForm" action="save_goals.php" method="post">
            <label for="goal_name">Goal Name:</label>
            <input type="text" id="goal_name" name="goal_name" required>

            <label for="target_amount">Target Amount:</label>
            <input type="text" id="target_amount" name="target_amount" min="1" required>

            <input type="submit" value="Set Goal">
        </form>

        <h2>Current Savings Goals</h2>
        <table id="goalsTable">
            <thead>
                <tr>
                    <th>Goal Name</th>
                    <th>Target Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through savings goals and display them in the table
                if (!empty($savingsGoals)) {
                    foreach ($savingsGoals as $goal) {
                        echo "<tr>
                            <td>{$goal['goal_name']}</td>
                            <td>{$goal['target_amount']}</td>
                        </tr>";
                    }
                } else {
                    // Display a message if no goals are set yet
                    echo "<tr><td colspan='2'>No savings goals set yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
