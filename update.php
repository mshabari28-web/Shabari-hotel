<?php
$conn = new mysqli("localhost","root","","hotel_db");

if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $name = $_POST['fullname'];
    $phone = $_POST['phone'];
    $room = $_POST['room_type'];

    $sql = "UPDATE bookings SET fullname='$name', phone='$phone',room_type='$room' WHERE id=$id";

    if($conn->query($sql) === TRUE){
        header("Location: admin.php");
        exit;
    }else{
        echo "Error updating record: ".$conn->error;
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM bookings WHERE id=$id");
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Booking</title>
        <style>
            body{
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .form-box{
                background:white;
                padding: 30px;
                border-radius:10px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                width:100%
                max-width: 400px;
            }

            h2{text-align: center; color:#333;margin-top:0;}

            label{font-weight:bold; margin-top:10px;display: black; color:#555;}
            input[type="text"], select{
                width: 100%;
                padding:10px;
                margin-top:5px;
                margin-bottom:15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }

            .btn-update{
                width:100%;
                padding:12px;
                background-color:#007bff;
                color:white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                font-weight: bold;
            }
            .btn-update:hover{background-color: #0056b3;}

            .popup-overlay{
                display: none;
                position: fixed; top:0; left: 0;width: 100%;height: 100%;
                background-color: rgba(0,0,0,0.6);
                justify-content: center;align-items:center;
                z-index: 1000;
            }
            .popup-box{
                background: white; padding: 25px; border-radius: 8px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.3); width: 300px;
            }
            .popup-box h3{margin-top: 0; color: #333;}
            .popup-buttons{display: flex; justify-content: space-around; margin-top: 20px;}
            .btn-yes, .btn-no{padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; width: 45%;}
            .btn.yes{background-color: #28a745;color:white;}
            .btn-yes:hover{background-color:#218838;}
            .btn-no{background-color: #dc3545; color: white;}
            .btn-no:hover{background-color:#c82333;}
            
        </style>
    </head>
    <body>
        <div class="form-box">
            <h2>Edit Booking</h2>
            <form id="updateForm" method="POST" action="update.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label>Name:</label>
                <input type="text" name="fullname" value="<?php echo $row['fullname'];?>">
                <lable>Phone:</label>
                <input type="text" name="phone" value="<?php echo $row['phone'];?>">

                <label>Room Type:</label>
                <select name="room_type">
                    <option value="AC Room" <?php if($row['room_type'] == 'AC Room') echo 'selected';?>>AC Room</option>
                    <option value="Non-AC Room" <?php if($row['room_type'] == 'Non-AC Room') echo 'selected';?>>Non-AC Room</option>
                </select>

                <button type="submit">Update Details</button>
            </form>
        </div>

        <div id="customPopup" class="popup-overlay">
            <div class="popup-box">
                <h3>Are your sure?</h3>
                <p>Details-a confirm ah update pannidalama?</p>
                <div class="popup-buttons">
                    <button type="button" id="btnYes" class="btn-yes">Yes</button>
                    <button type="button" id="btnNo" class="btn-No">No</button>
                </div>
            </div>
        </div>

        <script>
            const form = document.getElementById('updateForm');
            const popup = document.getElementById('customPopup');
            const btnYes = document.getElementById('btnYes');
            const btnNo = document.getElementById('btnNo');

            form.addEventListener('submit', function(event){
                event.preventDefault();
                popup.style.display = 'flex';
            });

            btnNo.addEventListener('click', function(){
                popup.style.display = 'none';
            });

            btnYes.addEventListener('click', function(){
                form.submit();
            });
        </script>
    </body>
</html>