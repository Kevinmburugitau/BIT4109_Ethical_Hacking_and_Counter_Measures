<?php
//mode B - with debug output

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "lab1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user = $_POST['username'];
$pass = $_POST['password'];

// INTENTIONALLY VULNERABLE SQL
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";

echo "<h3>DEBUG MODE ENABLED</h3>";
echo "<p><b>Injected SQL:</b><br>$sql</p>";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<p><b>MySQL ERROR:</b><br>" . mysqli_error($conn) . "</p>";
} else {
    echo "<p><b>Query executed successfully.</b></p>";
}

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Welcome, $user</h2>";
} else {
    echo "<h2>Invalid credentials</h2>";
}

mysqli_close($conn);
?>
