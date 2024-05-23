<?php
include 'profile-db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="pro.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h2><span style="color: #1aa3ff;">expense -</span>tracker application</h2>
            </div>
            <ul class="nav-links">
                <li><a href="index.php" class="nav-link">Dashboard</a></li>
                <li><a href="transaction.html" class="nav-link">Transactions</a></li>
                <li><a href="budget.html" class="nav-link">budget</a></li>
                <li><a href="profile.php" class="nav-link">Profile</a></li>
                <li><a href="savings.html" class="nav-link">savings</a></li>
                <li><a href="notification.html" class="nav-link">Notifications</a></li>

            </ul>
        </nav>
    </header>
    <div class="form-container">
        <div class="form-box">
            <h2 class="form-title">Profile</h2>
            <form id="profile-form" class="profile-form" action="profile-db.php" method="POST">
                <div class="form-group">
                    <label for="first_name">NAME:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $first_name;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo $email;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="job">Job:</label>
                    <input type="text" id="job" name="job" value="<?php echo $job;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $phone_number;?>" required>
                </div>
                <button type="submit" class="update-btn">Update</button>
            </form>
        </div>
    </div>
        <button class="logout-btn" onclick="logout()">Logout</button>
    <footer>
        <p class="footer-copyright">&copy; 2024 expense-tracker Platform. All rights reserved.</p>
    </footer>
    <script>
                
        function logout() {
            const confirmLogout = confirm("Are you sure you want to logout?");
            if (confirmLogout) {
                // Send a request to logout.php using AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'logout.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Redirect the user to index.html after successful logout
                        window.location.href = "login&register.html";
                    } else {
                        // Handle errors if needed
                        console.error('Error:', xhr.statusText);
                    }
                };
                xhr.onerror = function () {
                    // Handle network errors if needed
                    console.error('Network error');
                };
                xhr.send();
            }
        }
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            header.classList.toggle('scrolled', window.scrollY > 0);
        });
    </script>
</body>
</html>