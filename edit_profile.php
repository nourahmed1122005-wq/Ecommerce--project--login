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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $image = $user['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "uploads/" . $image_name);
        $image = $image_name;
    }
    $update = "UPDATE user SET username = '$username', email = '$email', image = '$image' WHERE id = $id";
    if (mysqli_query($connect, $update)) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: profile.php");
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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="edit-page">
        <div class="edit-card">
            <div class="edit-header">
                <h1>Edit Profile</h1>
                <p>Update your personal information</p>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <label>Username</label>
                <input type="text"  name="username" value="<?php echo $user['username']; ?>" required >
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>"required>
                <label>Profile Image</label>
                <input type="file" name="image" accept="image/*" >
                <button type="submit" class="save-btn"> Save Changes</button>
            </form>
            <a href="profile.php" class="back-profile">
                Back to Profile
            </a>
        </div>
    </div>
</body>
</html>