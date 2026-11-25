<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

$raw_data = file_get_contents("php://input");
$data = json_decode($raw_data, true);

if(empty($data['fullname']) || empty($data['phone']) || empty($data['room_type'])){
    echo json_encode(["status" => "error", "message" => "Ella details uh fill pannunga jii!"]);
    exit;
}

$conn = new mysqli("localhost","root","","hotel_db");
if($conn->connect_error){
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO bookings (fullname, phone, room_type) VALUES (?,?,?)");
$stmt->bind_param("sss", $data['fullname'], $data['phone'],$data['room_type']);

if($stmt->execute()){
    echo json_encode(["status"=>"success","message"=>"Booking confirmed!"]);
}else{
    echo json_encode(["status"=>"error", "message"=>"save panna mudiyala"]);
}
$stmt->close();
$conn->close();
?>