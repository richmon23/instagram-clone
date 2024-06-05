<?php
include_once 'connect.php';
$username = $_GET['username'];

// Mark notifications as seen
$updateNotifications = "UPDATE notifications SET seen = 1 WHERE username = '$username'";
mysqli_query($conn, $updateNotifications);

// Fetch notifications
$notificationQuery = "SELECT * FROM notifications WHERE username = '$username' ORDER BY created_at DESC";
$notificationResult = mysqli_query($conn, $notificationQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications | Instaclone</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <!-- Your navigation code here -->
    </nav>
    <main>
        <h1>Notifications</h1>
        <ul>
            <?php
            while ($notification = mysqli_fetch_assoc($notificationResult)) {
                echo "<li>{$notification['type']} notification at {$notification['created_at']}</li>";
            }
            ?>
        </ul>
    </main>
</body>
</html>
