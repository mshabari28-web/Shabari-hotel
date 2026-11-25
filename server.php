<?php
try{
$name = trim($_POST['fullname']);
$phone = trim($_POST['phone']);
$room = trim($_POST['room_type']);

if(empty($name)||empty($phone)||empty($room)){
    throw new Exception("Validation Error: Please fill all the fields.");
}

$conn = new mysqli("localhost","root","","hotel_db");

if($conn->connect_error){
    throw new Exception("Connection failed: ".$conn->connent_error);
}

$stmt = $conn->prepare("INSERT INTO bookings (fullname, phone, room_type) VALUES (?,?,?)");
$stmt->bind_param("sss",$name,$phone,$room);

if($stmt->execute()){
    echo "<h1>Super! Room Booked Successfully.</h1>";
    echo "<br><a href='index.html'>Go Back to Form</a>";
}else{
    throw new Exception("Query error: " . $stmt->error);
}

$stmt->close();
$conn->close();

}catch(Exception $e){
    echo "<h2>Oops! Server-la oru chinna pirachanai. Konja neram kalichu try pannunga.</h2>";
    echo "<br><a href='index.html'>Go Back</a>";
}
?>