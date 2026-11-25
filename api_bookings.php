<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("localhost","root","","hotel_db");
if($conn->connect_error){
    echo json_encode(["status" => "error","message" => "Database connection failed"]);
    exit;
}

$sql = "SELECT id, fullname, phone, room_type FROM bookings";
$result = $conn->query($sql);

$bookings_array = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $bookings_array[] = $row;
    }
}

echo json_encode($bookings_array);
$conn->close();
?>