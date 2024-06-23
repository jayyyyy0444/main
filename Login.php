<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];  
    $password = $_POST['Password'];  

    $conn = new mysqli("localhost", "root", "", "jayy");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("SELECT * FROM rus WHERE Username = ?");
    $stmt->bind_param("s", $username);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fetchdata = $result->fetch_assoc();

        if ($username == "" || $password == "") {  
            echo "<script>alert('Please enter both username and password');</script>";
        } elseif ($fetchdata['Password'] == $password) {  
            $_SESSION['username'] = $username;  
            header("Location: main.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items:  center;
            min-height: 100vh;
            background: url('images/Dazai Osamu.jpg') no-repeat;
            background-size: cover;
            background-position: center;
            font-family: sans-serif;
        }
        .container {
            width: 100%;
            max-width: 400px;
            text-align: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5); 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-left: 400px;
        }
        .container h2 {
            margin-bottom: 20px;
            color: darkblue;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container input[type="text"], .container input[type="password"] {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .container button {
            padding: 10px;
            font-size: 16px;
            background-color: darkblue;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .container button:hover {
            background-color: lightblue;
        }
        .container i {
            font-size: 14px;
        }
        .container i a {
            color: darkblue;
            text-decoration: none;
        }
        .container i a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
         if (!empty($error_message)) {
             echo "<div class='error-message'>$error_message</div>";
         }
         ?>
        <form method="POST" action="">
            <input type="text" id="Username" name="Username" placeholder="Username" required autofocus><br>
            <input type="password" id="Password" name="Password" placeholder="Password" required><br>
            <button type="submit">Login</button><br>
            <br>
            <i>Don't have an account? <a href="registration.php">Register</a></i>
        </form>
    </div>
</body>
</html>
