<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request");
}

$id = $_GET['id'];


$conn = mysqli_connect("localhost", "root", "", "contact_db");
if (!$conn) die("DB connection failed");


$sql = "SELECT name, email, message FROM messages WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
if (!$row) die("Message not found");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Message</title>
</head>
<body>

<h2>Edit Message</h2>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    Name:<br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>"><br><br>

    Email:<br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br><br>

    Message:<br>
    <textarea name="message"><?php echo htmlspecialchars($row['message']); ?></textarea><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>

<?php mysqli_close($conn); ?>
