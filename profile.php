<?php
session_start();
include("config.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id = $id";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>

    <div class="profile-page">

        <div class="profile-card">

            <div class="profile-header">
                <h1>My Profile</h1>
                <p>Welcome back, <?php echo $user['username']; ?>!</p>
            </div>

            <?php if (!empty($user['image'])): ?>
                <img 
                    class="profile-image"
                    src="uploads/<?php echo $user['image']; ?>"
                    alt="Profile Image"
                >
            <?php else: ?>
                <div class="profile-placeholder">
                    No Image
                </div>
            <?php endif; ?>

            <div class="profile-info">

                <div>
                    <span>Username</span>
                    <p><?php echo $user['username']; ?></p>
                </div>

                <div>
                    <span>Email</span>
                    <p><?php echo $user['email']; ?></p>
                </div>

                <div>
                    <span>User ID</span>
                    <p><?php echo $user['id']; ?></p>
                </div>

            </div>

            <div class="profile-actions">
                <a href="edit_profile.php" class="profile-btn">Edit Profile</a>
                <a href="logout.php" class="profile-btn">Logout</a>
                <a href="delete_profile.php" class="delete-btn">Delete Profile</a>
            </div>

        </div>

    </div>

</body>
</html>