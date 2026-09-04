<?php
session_start();
include("config.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "DELETE FROM user WHERE id = $id";
    if (mysqli_query($connect, $query)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Profile</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>
    <div class="delete-page">
        <div class="delete-card">
            <h1>Delete Profile</h1>
            <p>
                Are you sure you want to delete your profile?
                <br>
                This action cannot be undone.
            </p>
            <form method="POST">
                <button type="submit" class="confirm-delete">
                    Yes, Delete
                </button>
                <a href="profile.php" class="cancel-delete">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</body>
</html>