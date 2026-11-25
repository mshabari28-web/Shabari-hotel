<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Login</title>
        <style>
            body{
                font-family: Arial, sans-serif;
                background-color: #2c3e50;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 80vh;
                margin: 0;
            }
            .login-box{
                background: white;
                padding: 30px;
                border-radius : 10px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                width: 100%;
                max-width: 350px;
            }
            h2{text-align: center; color: #333; margin-top: 0;}
            label{font-weight:bold;margin-top:10px;display:block;color:#555;}
            input[type="text"],input[type="password"]{
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }
            button{
                width: 100%;
                padding: 12px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                font-size:16px;
                cursor: pointer;
                font-weight: bold;
            }
            button:hover{background-color: #0056b3;}
            .error{color: red;text-align:center;font-size: 14px;margin-bottom: 10px;display:none;}
        </style>
    </head>
    <body>
        <div class="login-box">
            <h2>Admin Login</h2>
            <div class="error" id="errorMsg">Invalid Username or Password!</div>
            <form method="POST" action="login_process.php">
                <label>Username:</label>
                <input type="text" name="username" required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>


