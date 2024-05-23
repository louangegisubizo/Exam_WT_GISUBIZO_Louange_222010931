<?php
require_once 'database_conn.php';
session_start();

// Fetch revenues from the database
try {
    $sql_revenue = "SELECT date_recieve AS date, amount, description FROM revenue ORDER BY date_recieve DESC";
    $stmt_revenue = $conn->query($sql_revenue);
    $revenues = $stmt_revenue->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching revenues: " . $e->getMessage();
}

// Fetch expenditures from the database
try {
    $sql_expense = "SELECT date_payed AS date, amount, description FROM expense ORDER BY date_payed DESC";
    $stmt_expense = $conn->query($sql_expense);
    $expenses = $stmt_expense->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching expenses: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Transaction Report</title>
    <link href="styles.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="index.php">ETA</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="index.php">Dashboard</a></li>
                    <li><a class="nav-link scrollto" href="transaction.html">Transactions</a></li>
                    <li><a class="nav-link scrollto" href="budget.html">Budget</a></li>
                    <li><a class="nav-link scrollto" href="savings.html">Savings Goals</a></li>
                    <li><a class="nav-link scrollto" href="#reports">Report</a></li>
                    <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
                    <li><a href="#" class="logout-link" onclick="logout()">Logout</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    <main id="main">
        <div class="container">
            <h2>Transaction Report</h2>
            <h3>Revenues</h3>
            <table class="transaction-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($revenues as $revenue) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($revenue['date']); ?></td>
                            <td><?php echo htmlspecialchars($revenue['amount']); ?></td>
                            <td><?php echo htmlspecialchars($revenue['description']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3>Expenditures</h3>
            <table class="transaction-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($expenses as $expense) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($expense['date']); ?></td>
                            <td><?php echo htmlspecialchars($expense['amount']); ?></td>
                            <td><?php echo htmlspecialchars($expense['description']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer id="footer">
        <div class="container">
            <h3>ETA</h3>
            <p>Expense tracker application got you covered.</p>
            <div class="social-links">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
            <div class="copyright">
                &copy; Copyright <strong><span>ETA</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>

    <script>
        function logout() {
            const confirmLogout = confirm("Are you sure you want to logout?");
            if (confirmLogout) {
                // Send a request to logout.php using AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'logout.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Redirect the user to login&register.html after successful logout
                        window.location.href = "login&register.html";
                    } else {
                        // Handle errors if needed
                        console.error('Error:', xhr.statusText);
                    }
                };
                xhr.onerror = function() {
                    // Handle network errors if needed
                    console.error('Network error');
                };
                xhr.send();
            }
        }
    </script>
</body>

</html>
