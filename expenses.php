<?php
require_once 'database_conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $date = $_POST['transaction_date'];

    try {
        // Prepare SQL statement to insert data into the expense table
        $sql_expense = "INSERT INTO expense (date_payed, amount, description) VALUES (?, ?, ?)";
        $stmt_expense = $conn->prepare($sql_expense);
        $stmt_expense->execute([$date, $amount, $description]);

        // Redirect to index.php after successful insertion
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
