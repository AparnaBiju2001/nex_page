<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashb.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
/* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

/* Gradient Background */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: url('background.jpg') no-repeat center center;
    background-size: cover; /* Adjusts image size */
    background-attachment: fixed; /* Keeps background fixed */
}

/* Optional: Add Overlay Effect */
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8); /* Light overlay */
    z-index: -1;
}

/* Main Container */
.container {
    display: flex;
    width: 80%;
    max-width: 100%;
    background: white;
    border-radius: 12px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 60%;
}

/* Left Side: Login Box */
.login-box {
    flex: 1;
    width: 600px;  /* Increase width */
    height: 600px; /* Increase height */
    padding: 0px; /* Increase padding */
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: white;
    border-radius: 12px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
}

/* Logo Styling */
.logo {
    width: 120px; /* Adjust size */
    margin-bottom: 20px; /* Space below logo */
}

/* Heading */
h2 {
    margin-bottom: 20px;
    color: #FF4255;
    font-size: 26px;
    font-weight: bold;
}

/* Input Fields */
.input-group {
    margin-bottom: 20px;
    width: 100%;
    text-align: left;
}

.input-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.input-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 16px;
    transition: 0.3s;
}

.input-group input:focus {
    border-color: #FF4255;
    outline: none;
}

/* Login Button */
.login-button {
    width: 100%;
    padding: 12px;
    background: #FF4255;
    color: white;
    font-size: 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
}

.login-button:hover {
    background: #D92F41;
    transform: scale(1.02);
}

/* Right Side: Image */
.image-box {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to bottom, #FF4255, #D92F41);
}

.image-box img {
    max-width: 40%;
    height: auto;
    margin-top: 50px;
}

/* Error Message */
.error {
    color: #FF4255;
    font-size: 14px;
    margin-top: 10px;
    font-weight: bold;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        height: auto;
    }
    
    .image-box {
        display: none; /* Hide image on small screens */
    }
    
    .login-box {
        padding: 30px;
    }
}
</style>
<body>
    <div class="container">
        <!-- Left Side: Login Form -->
        <div class="login-box">
            <img src="..\assets\logoo.png" alt="Company Logo" class="logo"> <!-- Add Logo Here -->
            <h2>Admin Login</h2>
            <form action="session.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
            </form>
        </div>
         <div class="scene">
        <div class="cube">
            <div class="face front"></div>
            <div class="face back"></div>
            <div class="face right"></div>
            <div class="face left"></div>
            <div class="face top"></div>
            <div class="face bottom"></div>
        </div>
    </div>

        <!-- Right Side: Image -->
        <div class="image-box">
            <img src="..\assets\admin2.png" alt="Login Illustration">
        </div>
    </div>
</body>
</html>
