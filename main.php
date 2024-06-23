<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");  
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
            background-color: rgba(255, 255, 255, 0.5); /* Transparent white background */
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
    <script>
        
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, location.href);
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>You have successfully logged in.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
