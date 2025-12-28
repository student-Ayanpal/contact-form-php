<?php
session_start(); // 🔥 VERY IMPORTANT

if (!isset($_POST['username'], $_POST['password'])) {
    die("Invalid request");
}

$username = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect("localhost", "root", "", "contact_db");
if (!$conn) die("DB connection failed");

$sql = "SELECT id, password FROM admins WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$admin = mysqli_fetch_assoc($result);

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id'] = $admin['id'];

    header("Location: admin.php");
    exit;
} else {
    echo "Invalid username or password";
}
mysqli_close($conn);
?>