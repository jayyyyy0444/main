<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "jayy");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM rus WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script type=text/javascript> alert('Username already exists'); </script>";
    } elseif ($username == "" || $password == "") {
        echo "<script type=text/javascript> alert('Put valid credentials'); </script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO rus(username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        echo "<script type=text/javascript> alert('Registration Successful!'); </script>";
        echo "<script type=text/javascript> window.location='login.php'; </script>";
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
            align-items: center;
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
            color: #007bff;
            text-decoration: none;
        }
        .container i a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button><br>
            <br>
            <i>Already have an account? <a href="login.php">Login</a></i>
        </form>
    </div>
</body>
</html>