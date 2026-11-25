<?php
$conn = new mysqli("localhost","root","","hotel_db");

if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM bookings WHERE id = $id";

if($conn->query($sql) === TRUE){
    header("Location: admin.php");
}else{
    echo "Error deleting record : " . $conn.error;
}

$conn->close();
?>