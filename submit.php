<?php

$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message']; 

if(empty($name)){
    die("Name is required");
}

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}

if(empty($message)){
    die("Message is required");
}

$conn=mysqli_connect("localhost","root","","contact_db");
if(!$conn){
    die("Connection failed: ");
}

$sql = "INSERT INTO MESSAGES(NAME,EMAIL,MESSAGE) VALUES ('$name','$email','$message')";

if(mysqli_query($conn,$sql)){
    echo "<h2>Message saved successfully!</h2>";
}
mysqli_close($conn);


?>