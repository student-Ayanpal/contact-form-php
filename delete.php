<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<?php

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id = $_GET['id'];

if (!is_numeric($id)) {
    die("Invalid ID");
}

$conn = mysqli_connect("localhost", "root", "", "contact_db");

if (!$conn) {
    die("Database connection failed");
}


$sql = "DELETE FROM messages WHERE id = ?";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param($stmt, "i", $id);


mysqli_stmt_execute($stmt);


mysqli_close($conn);


header("Location: admin.php");
exit;
?>
