<?php

$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message']; 

echo "<h2>Form Submitted Successfully</h2>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Email:</strong> $email</p>";
echo "<p><strong>Message:</strong> $message</p>";


?>