<?php
// 1. Validate input
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

// 2. Basic validation
if (empty($name) || empty($email) || empty($message)) {
    die("All fields are required");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email");
}

// 3. Connect to DB
$conn = mysqli_connect("localhost", "root", "", "contact_db");
if (!$conn) die("DB connection failed");

// 4. Update query (prepared)
$sql = "UPDATE messages SET name = ?, email = ?, message = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $message, $id);
mysqli_stmt_execute($stmt);

// 5. Close & redirect
mysqli_close($conn);
header("Location: admin.php");
exit;
?>
