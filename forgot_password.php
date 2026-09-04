<?php
include("config.php");
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $password = password_hash($new_password, PASSWORD_DEFAULT);
    $query = "UPDATE user SET password = '$password' WHERE email = '$email'";
    if (mysqli_query($connect, $query)) {
        $message = "Password changed successfully!";
    } else {
        $message = "Error changing password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="forgot-page">
        <h1>Forgot Password</h1>
        <p>Enter your email to reset your password.</p>
        <?php if ($message != ""): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input 
                type="email"  name="email"  placeholder="Email"  required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit" class="create-btn"> Continue</button>
        </form>
        <p>
            <a href="login.php">Back to Login</a>
        </p>
    </div>
</body>
</html>