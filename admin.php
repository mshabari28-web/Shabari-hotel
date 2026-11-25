<?php
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
    header("Location: adminlogin.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$conn = new mysqli("localhost","root","","hotel_db");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin - Shabari Hotel Bookings</title>
        <style>
            body{font-family:Arial,sans-serif;padding:20px;background-color:#f4f4f9;}
            h2{text-align:center;color:#333;}
            table{width:100%;border-collapse: collapse; margin-top:20px;background:white;}
            th, td {border: 1px solid #ccc; padding: 12px; text-align: left;}
            th{background-color: #28a745; color:white;}
            tr:nth-child(even) {background-color: #f2f2f2}
        </style>
    </head>
    <body>
        <h2>Shabari Hotel - Admin Dashboard</h2>
        <a href="logout.php" style="float: right; padding: 10px;background: red; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px">Logout</a>

        <table>
            <tr>
                <th>Booking ID</th>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Room Type</th>
                <th>Action</th>
            </tr>

            <?php
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['fullname'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['room_type'] . "</td>";
                    echo "<td>
                        <a href='delete.php?id=" . $row['id'] . "' style='color: red; font-weight: bold; text-decoration:none;'>Delete</a> | 
                        <a href='update.php?id=" . $row['id'] . "' style='color: blue; font-weight: bold; text-decoration:none;'>Edit</a>
                    </td>";
                    echo "</tr>";
                }
            }else{
                echo "<tr><td colspan = '4'>Innum evarum room book pannala.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
        <script>
            window.addEventListener("pageshow",function(event){
                if(event.persisted){
                    window.location.reload();
                }
            })
        </script>
    </body>
</html>