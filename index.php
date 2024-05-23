<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $welcome_message = "Welcome back, " . htmlspecialchars($_SESSION['username']) . "!";
} else {
    $welcome_message = "Welcome to our website!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>expense tracker application website</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="styles.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">ETA</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
  <ul>
    <li><a class="nav-link scrollto active" href="#index">Dashboard</a></li>
    <li><a class="nav-link scrollto" href="transaction.html">Transactions</a></li>
    <li><a class="nav-link scrollto" href="budget.html">Budget</a></li>
    <li><a class="nav-link scrollto" href="savings.php">Goals</a></li>
    <li><a class="nav-link scrollto" href="reports.php">Report</a></li>
    <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
    <li><a href="#" class="logout-link" onclick="logout()">Logout</a></li>
  </ul>
  <i class="bi bi-list mobile-nav-toggle"></i>
</nav>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  

  <main id="main">

    

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About Us</h2>
          <p>an expense tracker provides solutions for better financial management, planning, and decision-making, leading to improved financial health and stability..</p>
        </div>
        </div>
    </section><!-- End About Us Section --> 
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>ETA</h3>
      <p>expense tracker application got you covered.</p>
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
  </footer><!-- End Footer -->

      <script >    
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

  
  </script>
</body>

</html>