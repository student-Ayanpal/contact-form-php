<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<?php

if (
    !isset($_POST['id'], $_POST['name'], $_POST['email'], $_POST['message']) ||
    !is_numeric($_POST['id'])
) {
    die("Invalid request");
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


if (empty($name) || empty($email) || empty($message)) {
    die("All fields are required");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email");
}


$conn = mysqli_connect("localhost", "root", "", "contact_db");
if (!$conn) die("DB connection failed");


$sql = "UPDATE messages SET name = ?, email = ?, message = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $message, $id);
mysqli_stmt_execute($stmt);


mysqli_close($conn);
header("Location: admin.php");
exit;
?>
