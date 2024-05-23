<?php
session_start();

$host = 'localhost'; // or your host
$dbname = 'eta';
$username = 'gisubizo';
$password = '222010931';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // SQL query to authenticate the user
        $sql = "SELECT username FROM user WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // Authentication successful
            $_SESSION['username'] = $username; // Storing the username in the session
            header("Location: index.php"); // Redirect to home page
            exit();
        } else {
            // Authentication failed
            echo "<script>alert('Invalid username or password.'); window.location.href='login&register.html';</script>";
        }
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
