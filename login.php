<?php
session_start();
include("config.php");
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    header("Location: profile.php");
    exit();
} else {
    $message = "Invalid email or password";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SNEAKERS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="logo">
                SNEAKERS
            </div>
            <div class="left-content">
                <h2>
                    Step Into Your Style.<br>
                    Walk With Confidence.
                </h2>
                <p>
                    Discover sneakers made for your everyday style.
                </p>
            </div>
        </div>
        <!-- Right Side -->
        <div class="right-side">
            <h1>Welcome Back</h1>
            <p class="login-text">
                Don't have an account?
                <a href="index.php">Create account</a>
            </p>
            <?php if ($message != ""): ?>
            <p><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Enter your password" required>
                <div class="login-options">
                    <label>
                        <input type="checkbox" name="remember">Remember me</label>
                    <a href="forgot_password.php">Forgot password?</a>
                </div>
                <button type="submit" class="create-btn">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>