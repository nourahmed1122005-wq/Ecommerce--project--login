<?php
include("config.php");
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $username = $first_name . " " . $last_name;
    $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($connect, $query)) {
        $message = "Account created successfully!";
    } else {
        $message = "Error: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="logo">
                   SNEAKERS
            </div>
            <button class="back-btn">
                Back to website →
            </button>
            <div class="left-content">

    <h2>
        Step Into Your Style.<br>
        Walk With Confidence.
    </h2>

    <p>
        Discover sneakers made for your everyday style.
    </p>

    <div class="dots">
        <span class="active"></span>
        <span></span>
        <span></span>
    </div>

</div>
        </div>
        <!-- Right Side -->
        <div class="right-side">
            <h1>Create an account</h1>
            <p class="login-text">
                Already have an account?
               <a href="login.php">Log in</a>
            </p>
           <?php if ($message != ""): ?>
           <p><?php echo $message; ?></p>
           <?php endif; ?>
            <form method="POST">
                <div class="name-fields">
                    <input type="text" name="first_name" placeholder="First name" required>
                    <input type="text" name="last_name" placeholder="Last name" required>
                </div>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Enter your password" required>
                <label class="terms">
                    <input type="checkbox">
                    <span>I agree to the <a href="#">Terms & Conditions</a></span>
                </label>
                <button type="submit" class="create-btn">
                    Create account
                </button>
            </form>
            <div class="divider">
                <span></span>
                <p>Or register with</p>
                <span></span>
            </div>
            <div class="social-buttons">
                <button> 🌈 Google </button>
                <button>  Apple</button>
            </div>
        </div>
    </div>
</body>
</html>