<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>
<?php

$conn = mysqli_connect("localhost", "root", "", "contact_db");

if (!$conn) {
    die("Database connection failed");
}


$sql = "SELECT * FROM messages";


$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h2>Contact Messages</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
               echo "<td>
        <a href='edit.php?id=".$row['id']."'>Edit</a> |
        <a href='delete.php?id=".$row['id']."'
           onclick=\"return confirm('Are you sure you want to delete this message?');\">
           Delete
        </a>
      </td>";

                echo "</tr>";
            }
        } 
        else {
            echo "<tr><td colspan='4'>No messages found</td></tr>";
        }
        mysqli_close($conn);
        ?>
    </table>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>